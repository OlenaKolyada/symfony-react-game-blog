// app/components/home/HomePage.tsx
'use client';

import React from 'react';
import { LatestContainer } from '@/app/components/home';

export function HomePage() {

    const featuredCategories = ['news', 'review', 'game'];

    return (
        <div className="container mx-auto py-8">
            <section className="mb-8 bg-white border border-gray-200 rounded-lg shadow-md p-6">
                <h1 className="text-2xl font-bold text-teal-700 mb-2">Grem — Gaming Portal</h1>
                <p className="text-gray-600 mb-4">An academic portfolio project: a gaming portal featuring news, reviews, and a game catalog.</p>

                <div className="mb-4">
                    <span className="font-semibold text-gray-700">Stack: </span>
                    <span className="text-gray-600">PHP / Symfony 7 · Next.js / React / TypeScript · MySQL · Docker · AWS EC2</span>
                </div>

                <div>
                    <p className="font-semibold text-gray-700 mb-2">Features:</p>
                    <ul className="list-disc list-inside text-gray-600 space-y-1">
                        <li>Game, news and review catalog with pagination and sorting</li>
                        <li>User profiles and authentication</li>
                        <li>Admin panel (EasyAdmin) — access available upon request</li>
                        <li>REST API documented with Swagger/OpenAPI</li>
                    </ul>
                </div>
            </section>

            <section className="mb-3">
                <LatestContainer categoryNames={featuredCategories} />
            </section>
        </div>
    );
}