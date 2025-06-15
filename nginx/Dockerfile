# Gunakan image Nginx resmi yang ringan
FROM nginx:stable-alpine

# Hapus konfigurasi default Nginx
RUN rm /etc/nginx/conf.d/default.conf

# Salin file konfigurasi custom Anda dari folder nginx ke dalam kontainer
COPY default.conf /etc/nginx/conf.d/default.conf