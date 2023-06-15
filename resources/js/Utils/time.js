export const calculateDuration = (from, to) => {
    const duration = new Date(from).getTime() - new Date(to).getTime();
    let sec = 0;
    let min = 0;

    if (duration >= 0) {
        sec = Math.floor((duration / 1000) % 60);
        min = Math.floor(duration / (1000 * 60));
    }

    return {
        min,
        sec,
    };
};

export const formatDuration = (duration) => {
    if (duration.min === 0) return `${duration.sec} sec`;
    return `${duration.min} min ${duration.sec} sec`;
};
