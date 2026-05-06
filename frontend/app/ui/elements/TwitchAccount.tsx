import Image from "next/image";
import { getBrowserApiUrl } from "@/app/lib/config";

interface TwitchAccountProps {
    twitchUrl?: string | null;
    className?: string;
}

export function TwitchAccount({ twitchUrl, className = "mt-3" }: TwitchAccountProps) {
    if (!twitchUrl) return null;

    const apiBase = getBrowserApiUrl();

    return (
        <p className={className}>
            <a
                href={twitchUrl}
                target="_blank"
                rel="noopener noreferrer"
                className="inline-block"
            >
                <Image
                    src={`${apiBase}/uploads/images/assets/twitch-logo.png`}
                    alt="User Twitch Account"
                    width={50}
                    height={69}
                />
            </a>
        </p>
    );
}
