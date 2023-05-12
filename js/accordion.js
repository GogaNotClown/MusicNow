let accordion = document.querySelector('.accordion');
let questions = accordion.querySelectorAll('.accordion-question');
let title = accordion.querySelectorAll('.accordion-title');

function Accordion() {
    let AccordionQuestion = this.parentNode; // возвращаем родителя определённого элемента

    questions.forEach(item => {
        if (AccordionQuestion == item) {
            AccordionQuestion.classList.toggle('active-item'); // то добавляем класс, то убираем
            return;
        }
        item.classList.remove('active-item');
    });
}

title.forEach(question => question.addEventListener('click', Accordion));