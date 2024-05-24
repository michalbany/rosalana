export const dateForHumans = (date) => {
    const now = new Date();
    const updatedDate = new Date(date);
    const diffInSeconds = Math.floor((now - updatedDate) / 1000);
    const diffInMinutes = Math.floor(diffInSeconds / 60);
    const diffInHours = Math.floor(diffInMinutes / 60);
    const diffInDays = Math.floor(diffInHours / 24);
    const diffInMonths = Math.floor(diffInDays / 30);
    const diffInYears = Math.floor(diffInDays / 365);

    if (diffInYears > 0) {
        return `${diffInYears} year(s) ago`;
    } else if (diffInMonths > 0) {
        return `${diffInMonths} month(s) ago`;
    } else if (diffInDays > 0) {
        return `${diffInDays} day(s) ago`;
    } else if (diffInHours > 0) {
        return `${diffInHours} hour(s) ago`;
    } else if (diffInMinutes > 0) {
        return `${diffInMinutes} minute(s) ago`;
    } else {
        return "Just now";
    }
};

export const formatDateTime = (dateString) => {
    const date = new Date(dateString);
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    let hours = date.getHours();
    let minutes = date.getMinutes();

    day = day < 10 ? '0' + day : day;
    month = month < 10 ? '0' + month : month;
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;


    return `${day}.${month}.${year} ${hours}:${minutes}`;
}

export const formatDate = (dateString) => {
    const date = new Date(dateString);
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    day = day < 10 ? '0' + day : day;
    month = month < 10 ? '0' + month : month;

    return `${day}.${month}.${year}`;
};

export const formatTime = (dateString) => {
    const date = new Date(dateString);
    let hours = date.getHours();
    let minutes = date.getMinutes();

    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;

    return `${hours}:${minutes}`;
}

export const formatMonthYear = (dateString, { shortMonth = false, locale = 'en-US' } = {}) => {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: shortMonth ? 'short' : 'long' };
    const formattedDate = date.toLocaleDateString(locale, options);
    
    // Kapitalizace prvního písmene
    return formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);
};


export const formatNumber = (number, full = false) => {
    if (!full) {
        if (number > 1000000) {
            return `${new Intl.NumberFormat().format((number / 1000000).toFixed(1))}M`;
        }
        if (number > 1000) {
            return `${(number / 1000).toFixed(1)}K`;
        }
        if (number > 100) {
            return `${number.toFixed(0)}`;
        }
    }

    return new Intl.NumberFormat().format(number);
}