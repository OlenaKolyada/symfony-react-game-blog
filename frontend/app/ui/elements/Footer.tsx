// app/ui/elements/Footer.tsx

export function Footer() {
    const year = new Date().getFullYear();
    return (
        <div className="md:ml-0 bg-slate-900 border-t border-slate-700 mt-auto py-4">
            <div className="flex flex-col items-center">
                <p className="text-sm text-zinc-400">
                    &copy; {year} Grem
                </p>
            </div>
        </div>
    );
}