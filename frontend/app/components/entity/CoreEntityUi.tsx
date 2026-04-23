'use client'

import React from 'react';
import { Entity } from '@/app/lib/types';
import { capitalizeFirstLetter } from "@/app/lib/utils";
import * as em from "@/app/ui/elements/EntityMetadata";
import {
    BriefListContainer,
    DetailedListContainer
} from "@/app/components/list";
import { CommentsSection } from "@/app/components/comments";
import { EntityImage, EntityFields } from "@/app/ui/elements";

// Функция для получения мета-сущностей
function getMetaEntities(entity: Entity, categoryName: string): Entity[] {
    if (!entity || !categoryName) return [];
    const value = (entity as Record<string, unknown>)[categoryName];
    if (Array.isArray(value)) {
        return value;
    }
    return [];
}

interface CoreEntityCardProps {
    entityItem: Entity;
    categoryName: string;
    entityFields?: { label: string; value: keyof Entity; }[];

    relatedCoreCategories?: string[];
    relatedMetaCategories?: string[];
}

export function CoreEntityUi({
                                 entityItem,
                                 categoryName,
                                 entityFields = [],
                                 relatedCoreCategories = [],
                                 relatedMetaCategories = []
                             }: CoreEntityCardProps) {

    return (
        <main className="w-full p-3 md:p-9">
            <div className="bg-white border border-gray-200 p-3 md:p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                <div className="mx-1 md:mx-9 flex flex-col md:flex-1">
                    <div className="flex mb-1">
                        <em.EntityCategory category={categoryName}/>
                    </div>

                    <em.EntityTitle title={entityItem.title}/>

                    <div className="flex flex-wrap mb-1">
                        <em.EntityStatus status={entityItem.status}/>
                        <em.EntityDate date={entityItem.updatedAt}/>
                        {entityItem.author && <em.EntityAuthor author={entityItem.author}/>}
                    </div>

                    <div className="flex flex-col lg:flex-row my-5 md:my-9 gap-5 md:gap-6">
                        <div className="w-full lg:w-2/5 overflow-hidden">
                            <EntityImage
                                id={entityItem.id}
                                categoryName={categoryName}
                                title={entityItem.title}
                                coverUrl={entityItem?.coverUrl}
                                width="w-full"
                                height="h-[240px] sm:h-[300px] md:h-[350px]"
                            />
                        </div>

                        <div className="flex flex-col w-full lg:w-3/5 min-w-0">
                            {entityItem.content && (
                                <div
                                    className="text-gray-700 mb-4 prose max-w-none"
                                    dangerouslySetInnerHTML={{ __html: entityItem.content }}
                                />
                            )}

                            <EntityFields
                                entityItem={entityItem}
                                entityFields={entityFields}
                            />

                            {relatedMetaCategories.map(name => (
                                <BriefListContainer
                                    key={name}
                                    entityItems={getMetaEntities(entityItem, name)}
                                    categoryNames={[name]}
                                    label={capitalizeFirstLetter(name) + 's'}
                                />
                            ))}
                        </div>
                    </div>
                </div>

                <div className="ml-1 md:ml-9 mb-2 md:mb-9">
                    <DetailedListContainer
                        entityItem={entityItem}
                        categoryNames={[]}
                        relatedCategoryNames={relatedCoreCategories || []}
                        compact
                    />
                </div>

                {categoryName === 'review' && entityItem.id && (
                    <CommentsSection
                        comments={entityItem.comment}
                        reviewId={entityItem.id}
                    />
                )}
            </div>
        </main>
    );
}
