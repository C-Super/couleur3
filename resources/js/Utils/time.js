export const calculateDuration = (from, to) => {
    const duration = new Date(from).getTime() - new Date(to).getTime();

    const sec = Math.floor((duration / 1000) % 60);
    const min = Math.floor(duration / (1000 * 60));

    return {
        min,
        sec,
    };
};

export const formatDuration = (duration) => {
    if (duration.min === 0) return `${duration.sec} sec`;
    return `${duration.min} min ${duration.sec} sec`;
};
