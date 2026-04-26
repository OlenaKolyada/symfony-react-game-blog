// app/ui/elements/GremLogo.tsx

import Image from 'next/image';
import Link from 'next/link';
import { API_URL } from "@/app/lib/config/config";

export function GremLogo() {
    return (
        <div className="w-44 flex justify-center items-center">
            <Link href='/'>
                <Image
                    src={`${API_URL}/uploads/images/assets/logo.png`}
                    alt="Grem Logo"
                    width={100}
                    height={69}
                />
            </Link>
        </div>
    );
}
