import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  reactStrictMode: true,
  images: { domains: ['http://cashalaptop.dev.localhost/'] },   // WP media
  experimental: { serverActions: {} }, 
};

export default nextConfig;
