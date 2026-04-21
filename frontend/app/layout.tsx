// app/layout.tsx
import type { Metadata } from 'next';
import '@/app/ui/styles/global.css';
import { roboto } from '@/app/ui/fonts/fonts';
import { Header, Footer } from '@/app/ui/elements';
import { Providers } from '@/app/providers';
import { SideMenuContainer } from "@/app/components/menu";
import {Suspense} from "react";


export const metadata: Metadata = {
    description: 'Video game\'s news and reviews',
    title: 'Grem | Video game\'s news and reviews',
};

export default function RootLayout({
                                       children,
                                   }: {
    children: React.ReactNode;
}) {

    return (
        <html lang="en">
        <body className={`${roboto.className} antialiased min-h-screen flex flex-col`}>
        <Providers>
            <div className="flex flex-col flex-grow">
                <Header/>
                <div className="flex flex-col md:flex-row flex-grow min-h-0">
                    <Suspense fallback={<div></div>}>
                        <div className="hidden min-[1025px]:block min-[1025px]:w-56 min-[1025px]:shrink-0">
                            <SideMenuContainer/>
                        </div>
                    </Suspense>
                    <main className="flex-grow flex flex-col min-w-0 px-4 min-[1025px]:pl-0 min-[1025px]:pr-6">{children}</main>
                </div>
            </div>
            <Footer/>
        </Providers>
        </body>
        </html>
    );
}
