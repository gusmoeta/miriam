
  /*function changeLanguage(language) {
    var element = document.getElementById("url");
    element.value = language;
    element.innerHTML = language;
  },*/

  // function showDropdown() {
  //   document.getElementById("myDropdown").classList.toggle("show");
  // }

  // // Close the dropdown if the user clicks outside of it
  // window.onclick = function(event) {
  //   if (!event.target.matches('.dropbtn')) {
  //       var dropdowns = document.getElementsByClassName("dropdown-content");
  //       var i;
  //       for (i = 0; i < dropdowns.length; i++) {
  //           var openDropdown = dropdowns[i];
  //           if (openDropdown.classList.contains('show')) {
  //               openDropdown.classList.remove('show');
  //           }
  //       }
  //   }
  // }

$(document).ready(function(){
  
  $(".myDropdown").hide();
  var cont = 1;
  $(".dots").click(function(){
    if (cont == 1) {
      $(".myDropdown").show();
      cont = 0;
    }else{
      $(".myDropdown").hide();
      cont = 1;
    }    
  });


});


/*$( function() {
 
    // There's the gallery and the trash
    var $cards = $( "#card_list" ),
      $trash = $( "#trash" );
 
    // Let the gallery items be draggable
    $( "li", $cards ).draggable({
      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
      revert: "invalid", // when not dropped, the item will revert back to its initial position
      containment: "document",
      helper: "clone",
      cursor: "move"
    });
 
    // Let the trash be droppable, accepting the gallery items
    $trash.droppable({
      accept: "#card_list > li",
      classes: {
        "ui-droppable-active": "ui-state-highlight"
      },
      drop: function( event, ui ) {
        deleteImage( ui.draggable );
      }
    });
 
    // Let the gallery be droppable as well, accepting items from the trash
    $cards.droppable({
      accept: "#trash li",
      classes: {
        "ui-droppable-active": "custom-state-active"
      },
      drop: function( event, ui ) {
        recycleImage( ui.draggable );
      }
    });
 
    // Image deletion function
    function deleteImage( $item ) {
      $item.fadeOut(function() {
        var $list = $( "ul", $trash ).length ?
          $( "ul", $trash ) :
          $( "<ul class='card_list ui-helper-reset  ui-helper-clearfix'>" ).remove();
      });
    }
});*/

/*
$( function() {
  $( "#draggable" ).draggable();
  $( "#droppable" ).droppable({
    drop: function( event, ui ) {
      $( this )
        .addClass( "ui-state-highlight" )
        .find( "li" )
          .remove();
    }
  });
} );

*/