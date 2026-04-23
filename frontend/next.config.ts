import type { NextConfig } from "next";

const remotePatterns: NonNullable<NextConfig["images"]>["remotePatterns"] = [
    {
        protocol: 'http',
        hostname: '127.0.0.1',
        port: '8001'
    },
    {
        protocol: 'http',
        hostname: 'localhost',
        port: '8001'
    },
    {
        protocol: 'https',
        hostname: 'cdn.akamai.steamstatic.com'
    },
    {
        protocol: 'https',
        hostname: 'shared.akamai.steamstatic.com'
    }
];

const configuredApiUrl = process.env.NEXT_PUBLIC_API_URL;
if (configuredApiUrl) {
    try {
        const parsedApiUrl = new URL(configuredApiUrl);
        const alreadyIncluded = remotePatterns.some(
            (pattern) =>
                pattern.protocol === parsedApiUrl.protocol.replace(':', '') &&
                pattern.hostname === parsedApiUrl.hostname &&
                (pattern.port ?? '') === (parsedApiUrl.port || '')
        );

        if (!alreadyIncluded) {
            remotePatterns.push({
                protocol: parsedApiUrl.protocol.replace(':', '') as 'http' | 'https',
                hostname: parsedApiUrl.hostname,
                port: parsedApiUrl.port || undefined
            });
        }
    } catch {
        // Ignore malformed deployment configuration and keep default image hosts.
    }
}

const nextConfig: NextConfig = {
    images: {
        unoptimized: true,
        remotePatterns
    }
};

export default nextConfig;
