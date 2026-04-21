'use client';

import Link from 'next/link';
import { useState } from 'react';
import { GremLogo } from '@/app/ui/elements';
import { TopMenuContainer, navLinks, adminLinks, profileLinks } from '@/app/components/menu';
import { useAuth } from '@/app/components/auth';
import { BG_DARK_BLUE, BG_LIGHT_BLUE_HOVER, BG_MEDIUM_BLUE } from '@/app/ui/theme/colors';
import { Button } from '@/app/ui/elements/Button';

export function Header() {
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
    const { isAuthenticated, user, logout } = useAuth();
    const isAdmin = isAuthenticated && user?.roles?.includes('ROLE_ADMIN');

    const mobileLinks = [
        ...navLinks,
        ...(isAuthenticated ? profileLinks : []),
        ...(isAdmin ? adminLinks : []),
    ];

    return (
        <header className={`relative ${BG_DARK_BLUE} text-white`}>
            <div className="hidden min-[1025px]:grid grid-cols-[224px_1fr] items-center h-32 pr-6">
                <div className="flex pl-2">
                    <div className="w-[192px] flex justify-center">
                        <GremLogo/>
                    </div>
                </div>
                <div className="flex items-center justify-end gap-4 flex-1">
                    <TopMenuContainer/>
                </div>
            </div>

            <div className="flex min-[1025px]:hidden justify-between items-center px-3 py-3 min-h-20">
                <GremLogo/>
                <button
                    type="button"
                    onClick={() => setIsMobileMenuOpen((prev) => !prev)}
                    className="inline-flex h-10 w-10 items-center justify-center rounded border border-slate-500"
                    aria-expanded={isMobileMenuOpen}
                    aria-label="Toggle menu"
                >
                    <span className="sr-only">Menu</span>
                    <span className="flex flex-col gap-1">
                        <span className="block h-0.5 w-5 bg-white" />
                        <span className="block h-0.5 w-5 bg-white" />
                        <span className="block h-0.5 w-5 bg-white" />
                    </span>
                </button>
            </div>

            {isMobileMenuOpen && (
                <div className="min-[1025px]:hidden px-4 pb-4 border-t border-slate-700">
                    <nav className="flex flex-col gap-2 py-3">
                        {mobileLinks.map((link) => (
                            <Link
                                key={link.name}
                                href={link.href}
                                onClick={() => setIsMobileMenuOpen(false)}
                                className="text-sm text-white hover:text-teal-300"
                                {...(link.href.startsWith('http') ? { target: '_blank', rel: 'noopener noreferrer' } : {})}
                            >
                                {link.name}
                            </Link>
                        ))}
                    </nav>

                    {!isAuthenticated && (
                        <Link
                            href="/login"
                            onClick={() => setIsMobileMenuOpen(false)}
                            className="inline-block"
                        >
                            <Button className={`px-3 py-1 w-48 justify-center ${BG_MEDIUM_BLUE} ${BG_LIGHT_BLUE_HOVER}`}>
                                Sign In | Register
                            </Button>
                        </Link>
                    )}

                    {isAuthenticated && (
                        <button
                            type="button"
                            onClick={async () => {
                                await logout();
                                setIsMobileMenuOpen(false);
                            }}
                            className="text-sm text-white hover:text-teal-300"
                        >
                            Sign Out
                        </button>
                    )}
                </div>
            )}
        </header>
    );
}
