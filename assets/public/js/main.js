(function ($) {
  "use strict";
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/AdvancedPostsTab.default",function ($scope) {
        // gellary-image-animation
        $(".snake").snakeify({
          speed: 200,
        });
      }
    );
  });
})(jQuery);

//filterable gallery
("use strict");
function filteringGallery(imgGallery) {
  let filterBtns = imgGallery.querySelectorAll(
    ".apostst-my-commonsk-class .apostst-menu-item"
  );
  let galleryImg = imgGallery.querySelectorAll(
    ".apostst-grid-common .apostst-grid-item"
  );

  let itemPadding = getComputedStyle(galleryImg[0],null).getPropertyValue("padding");

  for (let btn of filterBtns) {
    // add click event to btn
    btn.addEventListener("click", () => {
      // add or remove button active class
      (function addRemoveBtnActiveClass() {
        for (let btnItem of filterBtns) {
          btnItem.classList.remove("active");
        }
        btn.classList.add("active");
      })();

      // get clicked button data-filter value
      let filterValue = btn.getAttribute("data-filter");

      //gallery img filtering by filter value
      (function checkingImgFiltering() {

        // adding Active Class to img
        function addingImgActiveClass(addItem) {
          addItem.style.padding = itemPadding;
          addItem.classList.add("apostst-img-galleryItem-active");
        }
        for (let imgItem of galleryImg) {
          // checking padding if img item has
       
          if (filterValue == "*") {
            addingImgActiveClass(imgItem);
          } else if (imgItem.classList.contains(filterValue)) {
            // removing img active class
            (function removingImgActiveClass() {
              for (let imgSingleItem of galleryImg) {
                if (!imgSingleItem.classList.contains(filterValue)) {
                  imgSingleItem.style.padding = "0";
                  imgSingleItem.style.maxWidth = "0";
                  imgSingleItem.classList.remove("apostst-img-galleryItem-active");
                }
              }
            })();
            addingImgActiveClass(imgItem);
          }
        }
      })();
    });
  }
}

//all galleryFilter player
const galleryFilterPlayer = () => {
  let allgalleryFilterCommon = document.querySelectorAll(".apostst-gallery-filtering-common");
  for (item of allgalleryFilterCommon) {
    filteringGallery(item);
  }
};


// editMode active or not
let apoststGalleryFilteringEditModeObserver = (getEditMode) => {
  // elementor render observing
  const apoststGalleryFilteringObserver = new MutationObserver((mutations) => {
    mutations.map((record) => {
      if (record.addedNodes.length) {
        record.addedNodes.forEach((singleItem) => {
          if (singleItem.nodeName == "DIV") {
            if (singleItem.querySelector(".apostst-gallery-filtering-common")) {
              let observedItem = singleItem.querySelector(".apostst-gallery-filtering-common");
              filteringGallery(observedItem);
            }
          }
        });
      }
    });
  });

  apoststGalleryFilteringObserver.observe(getEditMode, {
    subtree: true,
    childList: true,
  });
};
// edit mode checker
(() => {
  let apoststMyInterValId;
  if (
    document.querySelector(".elementor-edit-area") ||
    document.querySelector(".apostst-gallery-filtering-common")
  ) {
    galleryFilterPlayer();
  } else {
    apoststMyInterValId = setInterval(() => {
      let apoststElementorEditArea = document.querySelector(".elementor-edit-area");
      if (apoststElementorEditArea) {
        clearInterval(apoststMyInterValId);
        // play ===============
        apoststGalleryFilteringEditModeObserver(apoststElementorEditArea);
      }
    }, 300);
  }
})()
