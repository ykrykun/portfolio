$(function(lang){
    $(".dropdown-menu li a").click(function(){
      $(".btn:first-child").text($(this).text());
      $(".btn:first-child").val($(this).text());
   });
});

// $(document).ready(function(){
//   $(".lotterie-online .card").slice(0, 5).show();
//   $("#loadMore").on("click", function(e){
//     e.preventDefault();
//     $(".lotterie-online .card:hidden").slice(0, 5).slideDown();
//     if($(".lotterie-online .card:hidden").length == 0) {
//       $("#loadMore").text("").addClass("noContent");
//     }
//   });
// })

