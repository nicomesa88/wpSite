export default function page__links() {
  const page__links = document.querySelectorAll('.page__links button');

  for(let page_link of page__links) {

    const button__height =  page_link.clientHeight;
    page_link.style.height = button__height + 'px';

    page_link.addEventListener('click', function(e) {
      if( e.target.classList.contains('active') ) {
        e.target.classList.remove('active');
        e.target.style.height = button__height + 'px';
        return;
      }

      const content__div_height = e.target.querySelector('.content').clientHeight;
      e.target.style.height = content__div_height + 'px';
      e.target.classList.add('active');
    });

  }
}