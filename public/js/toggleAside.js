const openBtn = document.getElementById('aside-open-btn');
const closeBtn = document.getElementById('aside-close-btn');
const aside = document.querySelector('.phone-aside');
const bg = document.querySelector('.back-ground');
const asideWidth = aside.clientWidth;

openBtn.addEventListener('click', e => {
    e.preventDefault();
    bg.style.display = 'block';
    aside.style.transform = 'translateX(0)';
});

bg.addEventListener('click', () => {
    bg.style.display = 'none';
    aside.style.transform = `translateX(-${asideWidth}px)`;
});

closeBtn.addEventListener('click', () => {
    bg.style.display = 'none';
    aside.style.transform = `translateX(-${asideWidth}px)`;
});
