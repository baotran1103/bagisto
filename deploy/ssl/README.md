# SSL Certificates Directory

This directory should contain SSL certificates for HTTPS support.

## For Production SSL:

1. **Obtain SSL certificates** from Let's Encrypt or your CA
2. **Place certificate files here:**
   - `fullchain.pem` - Full certificate chain
   - `privkey.pem` - Private key

3. **File permissions:**
   ```bash
   chmod 600 privkey.pem
   chmod 644 fullchain.pem
   ```

## For Development/Testing:

You can use self-signed certificates:

```bash
# Generate self-signed certificate
openssl req -x509 -newkey rsa:4096 -keyout privkey.pem -out fullchain.pem -days 365 -nodes -subj "/CN=139.180.218.27"

# Set permissions
chmod 600 privkey.pem
chmod 644 fullchain.pem
```

## Nginx SSL Configuration:

The certificates will be automatically mounted to `/etc/nginx/ssl/` in the nginx container.

For HTTPS support, update nginx.conf to include SSL configuration or use a separate SSL server block.