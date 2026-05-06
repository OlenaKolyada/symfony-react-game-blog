// app/components/menu/menu-links.ts

import { API_URL } from "@/app/lib/config/config";

type Link = {
    name: string;
    href: string;
};

export const navLinks: Link[] = [
    { name: 'News', href: '/news' },
    { name: 'Reviews', href: '/review' },
    { name: 'Games', href: '/game' }
];

export const adminLinks: Link[] = [
    { name: 'Admin', href: API_URL ? `${API_URL}/admin` : '/admin' },
    { name: 'API Doc', href: API_URL ? `${API_URL}/api/doc` : '/api/doc' }
];

export const profileLinks: Link[] = [
    { name: 'User Profile', href: '/profile' }
];

export const topMenuStyles = {
    link: 'flex h-[40px] md:h-[48px] items-center justify-center gap-2 text-sm md:text-xl font-medium text-white-50 hover:text-teal-400 mr-3 md:mr-9',
    activeLink: 'text-teal-400',
    icon: 'w-6',
    text: 'block',
};

export const sideMenuStyles = {
    link: 'w-full hidden md:flex md:h-[48px] md:flex-none md:justify-start md:p-2 md:px-3',
    activeLink: 'bg-teal-500 text-white',
    text: 'md:block',
};
