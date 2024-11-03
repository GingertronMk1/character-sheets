export const shortenAbilityName = (val: string) => String(val).slice(0, 3).toUpperCase();

export const ucFirst = (val: string) =>
    String(val)
        // Split on non-letters
        .split(/[^a-zA-Z]/)
        // Capitalise first letters of words
        .map((word: string) => word.charAt(0).toUpperCase() + word.slice(1))
        // Join again
        .join(' ');
