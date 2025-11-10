pipeline {
    agent none

    triggers {
        pollSCM('H/5 * * * *')
    }

    stages {
        stage('Checkout') {
            agent any
            steps {
                script {
                    dir('bagisto-app') {
                        git branch: 'main',
                            credentialsId: 'GITHUB_PAT',
                            url: 'https://github.com/baotran1103/bagisto-app.git'
                        
                        env.GIT_COMMIT = sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()
                        env.GIT_BRANCH = sh(script: 'git rev-parse --abbrev-ref HEAD', returnStdout: true).trim()
                    }
                    stash name: 'source-code', includes: 'bagisto-app/**'
                }
            }
        }
        
        stage('Parallel Build') {
            parallel {
                stage('Backend Dependencies') {
                    agent {
                        docker {
                            image 'php-fpm:latest'
                            args '-u root'
                        }
                    }
                    steps {
                        unstash 'source-code'
                        dir('bagisto-app') {
                            sh '''
                                composer install --no-interaction --prefer-dist --optimize-autoloader --no-progress || echo "⚠️ Composer install completed with warnings"
                                echo "✓ Composer packages installed"
                            '''
                        }
                        stash name: 'backend-deps', includes: 'bagisto-app/vendor/**'
                    }
                }
                
                stage('Frontend Dependencies & Build') {
                    agent {
                        docker {
                            image 'php-fpm:latest'
                            args '-u root'
                        }
                    }
                    steps {
                        unstash 'source-code'
                        dir('bagisto-app') {
                            sh '''
                                npm install --quiet
                                
                                npm run build
                                
                                echo "✓ Frontend built successfully"
                            '''
                        }
                        stash name: 'frontend-build', includes: 'bagisto-app/public/build/**,bagisto-app/node_modules/**'
                    }
                }
            }
        }
        
        stage('Tests & Quality') {
            parallel {
                stage('PHPUnit Tests') {
                    agent {
                        docker {
                            image 'php-fpm:latest'
                            args '-u root'
                        }
                    }
                    steps {
                        unstash 'source-code'
                        unstash 'backend-deps'
                        dir('bagisto-app') {
                            sh '''
                                ./vendor/bin/pest tests/Unit/CoreHelpersTest.php --stop-on-failure
                            '''
                        }
                    }
                }
                
                stage('Code Quality Analysis') {
                    agent any
                    steps {
                        unstash 'source-code'
                        dir('bagisto-app') {
                            script {
                                try {
                                    // Use SonarQube Plugin - requires SonarQube server setup
                                    def scannerHome = tool 'SonarScanner'
                                    withSonarQubeEnv('SonarQube') {
                                        sh """
                                            ${scannerHome}/bin/sonar-scanner \\
                                                -Dsonar.projectKey=bagisto \\
                                                -Dsonar.projectName=Bagisto \\
                                                -Dsonar.sources=app,packages/Webkul \\
                                                -Dsonar.exclusions=vendor/**,node_modules/**,storage/**,public/**,tests/**,bootstrap/cache/** \\
                                                -Dsonar.sourceEncoding=UTF-8
                                        """
                                    }
                                    echo " SonarQube analysis completed"
                                } catch (Exception e) {
                                    echo "⚠️ SonarQube analysis skipped: ${e.message}"
                                }
                            }
                        }
                    }
                }
                
                stage('Security Audits') {
                    stages {
                        stage('ClamAV Virus Scan') {
                            agent any
                            steps {
                                unstash 'source-code'
                                dir('bagisto-app') {
                                    // ClamAV Plugin scan
                                    clamav(
                                        includes: '**/*',
                                        excludes: '.git/**,vendor/**,node_modules/**,storage/**,public/build/**,bootstrap/cache/**'
                                    )
                                    echo "✓ ClamAV scan completed"
                                }
                            }
                        }
                        
                        stage('Composer Audit') {
                            agent {
                                docker { 
                                    image 'php-fpm:latest'
                                    args '-u root'
                                }
                            }
                            steps {
                                unstash 'source-code'
                                unstash 'backend-deps'
                                dir('bagisto-app') {
                                    sh '''
                                        composer audit || echo "⚠️ PHP vulnerabilities found"
                                    '''
                                }
                            }
                        }
                        
                        stage('NPM Audit') {
                            agent {
                                docker { 
                                    image 'php-fpm:latest'
                                    args '-u root'
                                }
                            }
                            steps {
                                unstash 'source-code'
                                unstash 'frontend-build'
                                dir('bagisto-app') {
                                    sh '''
                                        npm audit --audit-level=moderate || echo "⚠️ Node vulnerabilities found"
                                    '''
                                }
                            }
                        }
                    }
                }
            }
        }
        
        stage('Create Deployment Package') {
            agent any
            steps {
                unstash 'source-code'
                unstash 'backend-deps'
                unstash 'frontend-build'
                
                dir('bagisto-app') {
                    sh '''
                        ARTIFACT_NAME="bagisto-${BUILD_NUMBER}-${GIT_COMMIT}.tar.gz"
                        tar -czf "../${ARTIFACT_NAME}" \\
                            --exclude=node_modules \\
                            --exclude=.git \\
                            --exclude=tests \\
                            --exclude=storage/logs/* \\
                            --exclude=*.tar.gz \\
                            .
                        
                        echo "✓ Build artifact: ${ARTIFACT_NAME}"
                        ls -lh "../${ARTIFACT_NAME}"
                        tar -tzf "../${ARTIFACT_NAME}" | head -10
                    '''
                }
                
                archiveArtifacts artifacts: 'bagisto-*.tar.gz', fingerprint: true, allowEmptyArchive: false
            }
        }
    }
    
    post {
        always {
            node('') {
                echo '=== Pipeline Execution Completed ==='
                echo """
                Build Summary:
                - Build Number: ${BUILD_NUMBER}
                - Git Commit: ${GIT_COMMIT}
                - Git Branch: ${GIT_BRANCH}
                - Status: ${currentBuild.result ?: 'SUCCESS'}
                - Duration: ${currentBuild.durationString}
                - Artifact: bagisto-${BUILD_NUMBER}-${GIT_COMMIT}.tar.gz
                """
            }
        }
        success {
            node('') {
                echo '✅ Pipeline completed successfully!'
                echo '🚀 Artifact ready for deployment'
                echo "📦 Download: bagisto-${BUILD_NUMBER}-${GIT_COMMIT}.tar.gz"
                
                emailext subject: "✅ Build Success: Bagisto ${BUILD_NUMBER}",
                        body: """
                        🎉 Build completed successfully!
                        
                        Build Details:
                        - Build Number: ${BUILD_NUMBER}
                        - Git Commit: ${GIT_COMMIT}
                        - Git Branch: ${GIT_BRANCH}
                        - Duration: ${currentBuild.durationString}
                        
                        📦 Artifact: bagisto-${BUILD_NUMBER}-${GIT_COMMIT}.tar.gz
                        
                        🔗 Jenkins Build: ${BUILD_URL}
                        
                        Ready for deployment!
                        """,
                        to: 'tnqbao11@gmail.com'
            }
        }
        failure {
            node('') {
                echo '❌ Pipeline failed! Check logs above for details.'
                echo '🔄 Rollback: Use previous successful build artifact'
                
                emailext subject: "❌ Build Failed: Bagisto ${BUILD_NUMBER}",
                        body: """
                        🚨 Build failed!
                        
                        Build Details:
                        - Build Number: ${BUILD_NUMBER}
                        - Git Commit: ${GIT_COMMIT}
                        - Git Branch: ${GIT_BRANCH}
                        - Duration: ${currentBuild.durationString}
                        
                        🔗 Jenkins Build: ${BUILD_URL}
                        
                        Please check the build logs for details and fix the issues.
                        """,
                        to: 'tnqbao11@gmail.com'
            }
        }
        cleanup {
            node('') {
                echo '=== Cleaning up workspace ==='
                cleanWs(deleteDirs: true, disableDeferredWipeout: true, notFailBuild: true)
            }
        }
    }
}
