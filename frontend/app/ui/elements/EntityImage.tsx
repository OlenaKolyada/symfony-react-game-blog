import Image from "next/image";
import { API_URL } from "@/app/lib/config/config";

interface EntityImageProps {
    id: number | undefined;
    categoryName: string;
    title?: string;
    coverUrl?: string;
    width?: string;
    height?: string;
    className?: string;
    imageType?: 'cover' | 'avatar'; // Новый параметр
}

export function EntityImage({
                                id,
                                categoryName,
                                title,
                                coverUrl,
                                width = "w-full",
                                height = "h-[250px]",
                                className = "",
                                imageType = 'cover'
                            }: EntityImageProps) {
    const toAbsolute = (path: string) => {
        if (path.startsWith('http')) return path;
        const normalized = path.startsWith('/') ? path : `/${path}`;
        return `${API_URL}${normalized}`;
    };

    const imageUrl = coverUrl
        ? toAbsolute(coverUrl)
        : `${API_URL}/uploads/images/${categoryName}/${id}/${imageType}.jpg`;

    return (
        <div className={`relative ${width} ${height} shrink-0 overflow-hidden ${className}`}>
            <Image
                src={imageUrl}
                alt={title ?? ''}
                fill
                className="object-cover object-center rounded-lg"
                sizes="(max-width: 768px) 100vw, 400px"
            />
        </div>
    );
}
