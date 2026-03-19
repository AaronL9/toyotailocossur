export default function VehicleModelCard(data: any): HTMLElement {
    const article = document.createElement("article");
    article.className = "group";

    const link = document.createElement("a");
    link.href = "#";
    link.className = "block";

    /** IMAGE CONTAINER */
    const imgContainer = document.createElement("div");
    imgContainer.className =
        "aspect-4/3 bg-zinc-100 overflow-hidden mb-3 group-hover:shadow-md transition-all duration-200 animate-pulse";

    /** IMAGE LOADER */
    const imgLoader = document.createElement("div");
    imgLoader.className = "w-full h-full p-2 bg-[#f4f4f5]";

    imgContainer.append(imgLoader);

    /** IMAGE ELEMENT */
    const img = document.createElement("img");
    img.src = "/img/vehicles/1.webp";
    img.alt = data.vehicle_title;
    img.classList.add(
        "w-full",
        "h-full",
        "object-contain",
        "object-center",
        "p-2",
        "opacity-0",          // hide initially
        "transition-opacity",
        "duration-300"
    );
    img.loading = "lazy";
    imgContainer.append(img);

    const title = document.createElement("h3");
    title.className =
        "text-slate-800 font-semibold text-center text-sm sm:text-base";
    title.textContent = data.vehicle_title;

    const explore = document.createElement("p");
    explore.className =
        "text-red-600 font-semibold text-center text-xs sm:text-sm tracking-widest uppercase mt-1 group-hover:underline";
    explore.textContent = "Explore";

    link.append(imgContainer, title, explore);
    article.append(link);

    img.addEventListener("load", () => {
        img.classList.remove("opacity-0");
        imgContainer.classList.remove("animate-pulse");
        imgLoader.remove();
    });

    return article;
}