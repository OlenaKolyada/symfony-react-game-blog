// app/components/menu/TopMenuUi.tsx
'use client';

import Link from "next/link";
import { usePathname } from 'next/navigation';
import { adminLinks, profileLinks, topMenuStyles } from '@/app/components/menu';

interface TopMenuUiProps {
    isAdmin?: boolean;
    isAuthenticated?: boolean;
}

export function TopMenuUi({ isAdmin = false, isAuthenticated = false }: TopMenuUiProps) {
    const pathname = usePathname();
    const visibleProfileLinks = pathname === '/profile' ? [] : profileLinks;

    return (
        <div className={`flex h-full flex-row flex-wrap justify-end px-1 md:px-2`}>
            {isAdmin && (
                <>
                    {adminLinks.map(link => (
                        <Link
                            key={link.name}
                            href={link.href}
                            className={topMenuStyles.link}
                            {...(link.name === 'API Doc' ? { target: "_blank", rel: "noopener noreferrer" } : {})}
                        >
                            {link.name}
                        </Link>
                    ))}
                </>
            )}

            {isAuthenticated && (
                <>
                    {visibleProfileLinks.map(link => (
                        <Link
                            key={link.name}
                            href={link.href}
                            className={topMenuStyles.link}
                        >
                            {link.name}
                        </Link>
                    ))}
                </>
            )}
        </div>
    );
}
