const loadMoreBtn = document.getElementById('loadMoreBtn');
const boxContainer = document.getElementById('boxContainer');
const boxesToShowInitially = BboxesToShowInitially;
const boxes = boxContainer.querySelectorAll('.box');
let isHiddenVisible = false;

if (boxes.length <= boxesToShowInitially) {
  loadMoreBtn.style.display = 'none';
} else {
  boxes.forEach((box, index) => {
    if (index >= boxesToShowInitially) {
      box.classList.add('hidden');
    }
  });
}

loadMoreBtn.addEventListener('click', toggleHiddenBoxes);

function toggleHiddenBoxes() {
  boxes.forEach((box, index) => {
    if (index >= boxesToShowInitially) {
      box.classList.toggle('hidden');
    }
  });

  if (isHiddenVisible) {
    loadMoreBtn.textContent = 'Load More';
  } else {
    loadMoreBtn.textContent = 'Show Less';
  }

  isHiddenVisible = !isHiddenVisible;
}