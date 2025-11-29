#!/bin/bash

# HTTPS Quick Setup Script for Coffee Finder Application
# This script helps you quickly configure HTTPS using Let's Encrypt

echo "=========================================="
echo "HTTPS Configuration for Coffee Finder"
echo "=========================================="
echo ""

# Check if running as root
if [ "$EUID" -ne 0 ]; then 
    echo "Please run as root (use sudo)"
    exit 1
fi

# Step 1: Install Certbot
echo "Step 1: Installing Certbot..."
apt update
apt install -y certbot python3-certbot-nginx

if [ $? -ne 0 ]; then
    echo "Error: Failed to install Certbot"
    exit 1
fi

echo "✓ Certbot installed successfully"
echo ""

# Step 2: Get domain name
echo "Step 2: Domain Configuration"
read -p "Enter your domain name (e.g., coffee-finder-b123456.duckdns.org): " DOMAIN

if [ -z "$DOMAIN" ]; then
    echo "Error: Domain name cannot be empty"
    exit 1
fi

echo "Domain: $DOMAIN"
echo ""

# Step 3: Check if Nginx is configured
echo "Step 3: Checking Nginx configuration..."
if [ ! -f "/etc/nginx/sites-available/coffee-finder" ]; then
    echo "Warning: Nginx configuration file not found at /etc/nginx/sites-available/coffee-finder"
    echo "Please ensure Nginx is configured before continuing"
    read -p "Continue anyway? (y/n): " CONTINUE
    if [ "$CONTINUE" != "y" ]; then
        exit 1
    fi
fi

# Update Nginx config with domain name
if [ -f "/etc/nginx/sites-available/coffee-finder" ]; then
    echo "Updating Nginx configuration with domain name..."
    sed -i "s/server_name.*;/server_name $DOMAIN;/g" /etc/nginx/sites-available/coffee-finder
    
    # Test Nginx configuration
    nginx -t
    if [ $? -eq 0 ]; then
        systemctl reload nginx
        echo "✓ Nginx configuration updated"
    else
        echo "Error: Nginx configuration test failed"
        exit 1
    fi
fi

echo ""

# Step 4: Obtain SSL certificate
echo "Step 4: Obtaining SSL certificate from Let's Encrypt..."
echo "This will validate your domain ownership..."
echo ""

certbot --nginx -d $DOMAIN --non-interactive --agree-tos --email admin@$DOMAIN --redirect

if [ $? -ne 0 ]; then
    echo ""
    echo "Error: Failed to obtain SSL certificate"
    echo "Possible reasons:"
    echo "  1. DNS not properly configured"
    echo "  2. Domain not pointing to this server"
    echo "  3. Port 80 not accessible"
    echo ""
    echo "Please check:"
    echo "  - DNS records: nslookup $DOMAIN"
    echo "  - Security group: Ensure port 80 and 443 are open"
    echo "  - Firewall: sudo ufw allow 80/tcp && sudo ufw allow 443/tcp"
    exit 1
fi

echo ""
echo "✓ SSL certificate obtained successfully"
echo ""

# Step 5: Test certificate renewal
echo "Step 5: Testing certificate auto-renewal..."
certbot renew --dry-run

if [ $? -eq 0 ]; then
    echo "✓ Auto-renewal configured correctly"
else
    echo "Warning: Auto-renewal test failed, but certificate is valid"
fi

echo ""

# Step 6: Update Laravel .env
echo "Step 6: Updating Laravel configuration..."
if [ -f "/var/www/coffee-finder/.env" ]; then
    sed -i "s|APP_URL=.*|APP_URL=https://$DOMAIN|g" /var/www/coffee-finder/.env
    
    # Check if ASSET_URL exists, if not add it
    if ! grep -q "ASSET_URL" /var/www/coffee-finder/.env; then
        echo "ASSET_URL=https://$DOMAIN" >> /var/www/coffee-finder/.env
    else
        sed -i "s|ASSET_URL=.*|ASSET_URL=https://$DOMAIN|g" /var/www/coffee-finder/.env
    fi
    
    cd /var/www/coffee-finder
    php artisan config:clear
    php artisan cache:clear
    
    echo "✓ Laravel configuration updated"
else
    echo "Warning: .env file not found at /var/www/coffee-finder/.env"
fi

echo ""

# Step 7: Verify HTTPS
echo "Step 7: Verifying HTTPS configuration..."
echo ""
echo "Testing HTTPS connection..."
curl -I https://$DOMAIN 2>&1 | head -5

echo ""
echo "=========================================="
echo "HTTPS Configuration Complete!"
echo "=========================================="
echo ""
echo "Your application is now accessible at:"
echo "  https://$DOMAIN"
echo ""
echo "Certificate information:"
certbot certificates
echo ""
echo "Next steps:"
echo "  1. Visit https://$DOMAIN in your browser"
echo "  2. Verify the SSL certificate is valid"
echo "  3. Test all application features"
echo "  4. Prepare for demonstration"
echo ""
echo "Certificate will auto-renew every 90 days"
echo ""

