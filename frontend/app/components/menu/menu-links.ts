// app/components/menu/menu-links.ts

import { API_URL } from "@/app/lib/config/config";

type Link = {
    name: string;
    href: string;
};

export const navLinks: Link[] = [
    { name: 'News', href: '/news' },
    { name: 'News Draft', href: '/news?status=Draft' },
    { name: 'News Archived', href: '/news?status=Archived' },
    { name: 'News Deleted', href: '/news?status=Deleted' },
    { name: 'Reviews', href: '/review' },
    { name: 'Reviews Draft', href: '/review?status=Draft' },
    { name: 'Reviews Archived', href: '/review?status=Archived' },
    { name: 'Reviews Deleted', href: '/review?status=Deleted' },
    { name: 'Games', href: '/game' },
    { name: 'Games Draft', href: '/game?status=Draft' },
    { name: 'Games Archived', href: '/game?status=Archived' },
    { name: 'Games Deleted', href: '/game?status=Deleted' }
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
