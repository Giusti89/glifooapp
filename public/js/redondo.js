const imgContainer = document.getElementById("figura");

const observer = new IntersectionObserver(callback, {
    threshold: 0.8
});

function callback(entries) {
    entries.forEach(entry => {
        const image = entry.target.querySelector('img');
        image.classList.toggle('unset', entry.isIntersecting);
    });
}

document.querySelectorAll("#figura img").forEach(image => {
    observer.observe(image);
});