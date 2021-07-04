jQuery(document).ready(function ($) {
  const $testimonialBtn = $(".section-testimonials__btn");
  const $html = $("html");
  const $testimonialDialog = $(".testimonial-dialog");
  const $testimonialCloseElememts = $(".dialog__overlay, .dialog__close");

  $testimonialBtn.on("click", function () {
    $testimonialDialog.addClass("active");
    $html.addClass("overflov-hidden");
    const name = $(this).siblings(".section-articles__title").text();
    const fullText = $(this)
      .siblings(".section-articles__except.full-text")
      .text();
    const ImageSrc = $(this)
      .siblings(".section-articles__pic")
      .find("img")
      .attr("src");

    $(".testimonial-dialog__name").text(name);
    $(".testimonial-dialog__full-text").text(fullText);
    $(".testimonial-dialog__pic img").attr("src", ImageSrc);
  });

  $testimonialCloseElememts.on("click", function () {
    $testimonialDialog.removeClass("active");
    $html.removeClass("overflov-hidden");
  });

  console.log(localizedObject);

  const $galleryShowMoreBtn = $(".gallary__show-more");
  let page = 1;

  $galleryShowMoreBtn.on("click", function () {
    $(".gallery__loading").show();
    const $gallaryItems = $(".gallery__items");
    $.ajax({
      type: "post",
      dataType: "json",
      url: localizedObject.ajaxurl,
      data: {
        action: "ajax_more",
        _ajax_nonce: localizedObject.nonce,
        page: page,
      },
      success: function (response) {
        page = response.page;
        console.log(response.page);
        let result = "";

        response.data.map((imgObject) => {
          result += `
               <a class="gallery__item"
       data-fancybox='gallery'
       href="${imgObject["url"]} ">
       <img src="${imgObject["sizes"]["medium_large"]}" alt="">
    </a> 
          `;
        });
        $(".gallery__loading").hide();

        $gallaryItems.append(result.trim());
        if (response.all_items === $(".gallery__item").length) {
          $(".gallary__show-more").remove();
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  });

  //переключение табов
  const $title = $(".tabs__title");
  $title.on("click", function () {
    $(this)
      .addClass("active")
      .siblings()
      .removeClass("active")
      .closest(".container")
      .find(".tabs__content-item")
      .removeClass("active")
      .eq($(this).index())
      .addClass("active");
  });

  //Обработка контактной формы

  const $hiddenInput = $("input[name=hidden-input]");
  const pageTitle = $(".contact-us__page-title").text();
  $hiddenInput.val(pageTitle);

  const wpcf7Elm = $(".wpcf7");
  console.log(wpcf7Elm);

  if (wpcf7Elm) {
    wpcf7Elm.on("wpcf7invalid", function (event) {
      console.log("wpcf7invalid 3342342");
    });
  }

  $(".gallery__items").slick({
    arrows: true,
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 3000,
    lazyLoad: "undemand",
  });

  $(".slick-arrow,.slick-prev").html("<");

  $(".slick-next").html(">");
});
