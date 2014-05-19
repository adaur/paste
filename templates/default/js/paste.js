jQuery(document).ready(function() {

// Pajinate Pagination
if ($("#pagination-activity")[0]){
  $('#pagination-activity').pajinate({
     items_per_page : 10,
    });
};

if ($("#pagination-messages")[0]){
  $('#pagination-messages').pajinate({
    items_per_page : 6,
  });
};

if ($("#pagination-todo")[0]){

  function todoPagination() {
    $('#pagination-todo').pajinate({
      items_per_page : 11,
    });
  }

  todoPagination();

};

// Photoswipe
if ($(".gallery")[0]){

    function photoSwiper() {
        var myPhotoSwipe = $(".gallery a").photoSwipe(
            { 
                enableMouseWheel: true, 
                enableKeyboard: true,
                zIndex: 2034 
            });
    };

    photoSwiper();
};

// Gallery Hover
if ($(".gallery")[0]){

    function galleryHover() {
        $(".gallery a").hover(
            function() {
                // Called when the mouse enters the element
                $(this).prepend("<div class='icon-eye-open'></div>");

                $(this).find("img").css({
                    "filter": "alpha(opacity=100)",
                    "opacity": "1",
                  });
            },
            function() {
                // Called when the mouse leaves the element
                $(this).find(".icon-eye-open").remove();

                $(this).find("img").css({
                    "filter": "alpha(opacity=75)",
                    "opacity": "0.75",
                  });
            }
         );
    };
    galleryHover();
};

// Isotope
if ($(".gallery")[0]){

  $(function () {

      var $container = $('.gallery');

      $container.isotope({
          itemSelector: '.element',
          layoutMode: 'masonry',
      });


  $(window).smartresize(function(){
     $container.isotope({
       resizable: false, // disable normal resizing
       masonry: { columnWidth: $container.width() / 5 }
     });
     // trigger resize to trigger isotope
  }).smartresize();

  // trigger isotope again after images have loaded
  $container.imagesLoaded( function(){
    $(window).smartresize();
  });


      var $optionSets = $('.gallery-sorting'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function () {
          var $this = $(this);
          // don't proceed if already selected
          if ($this.parent().hasClass('active')) {
              return false;
          }
          var $optionSet = $this.parents();

          $optionSet.find('.gallery-sorting .active').removeClass('active');
          $this.parent().addClass('active');

          // make option object dynamically, i.e. { filter: '.my-filter-class' }
          var options = {},
          value = $this.attr('data-option-value');

          // parse 'false' as false boolean
          console.log(value);
          options = {filter: value};

          // creativewise, apply new options
          $container.isotope(options);

          return false;
      });


  });

};

// Tabs (bootstrap)

//    $('.tab-container a').click(function (e) {
//      e.preventDefault();
//      $(this).tab('show');
//    })

// jQuery UI: Sortable for Box Widgets (wells)

/*
  $(function() {
    $(".row-fluid").sortable({
        connectWith: ".row-fluid",
        start: function(e, ui){
          ui.placeholder.height(ui.item.height());
        }
    });
 
 */
    $(".container").find(".top-bar")
        .append("<div>"
                + "<a href='#' class='top-bar-minimize' rel='tooltip' title='Minimize'><i class='icon-chevron-up'></i></a> "
                + "</div>")
        .end()
    /*.find(".well");*/

    $(".top-bar div .top-bar-minimize").click(function() {
          $this = $(this).parent().parent().parent();
        if($($this).find(".top-bar").hasClass("top-bar-closed")) {
            $($this).find(".top-bar").removeClass("top-bar-closed");
            $($this).find(".well").slideDown({duration: 1000, easing: 'easeOutBack'});
        }
        else {
            $($this).find(".well").slideUp('medium', function() {
                $(this).parent().find(".top-bar").addClass("top-bar-closed"); 
            });
        };
        
        return false;
    });
/*
    $(".row-fluid").disableSelection();

  });
*/

// Tooltip (bootstrap)
$("[rel='tooltip']").tooltip();

$("[rel='tooltip']").each(function( index ) {
  $(this).data('tooltip').options.placement = 'bottom';
});

// Chosen
if ($("select")[0]){

  $("select").chosen({disable_search_threshold: 10});

};
});
	function showdiv(e) {
    document.getElementById(e).style.display = "inline"
}
	function selectText(e) {
		if (document.selection) {
			var t = document.body.createTextRange();
			t.moveToElementText(document.getElementById(e));
			t.select()
		} else if (window.getSelection) {
			var t = document.createRange();
			t.selectNode(document.getElementById(e));
			window.getSelection().addRange(t)
		}
	}

    function checkTab(e) {
        if (document.all && 9 == event.keyCode) {
            e.selection = document.selection.createRange();
            setTimeout("processTab('" + e.id + "')", 0)
        }
    }

    function processTab(e) {
        document.all[e].selection.text = String.fromCharCode(9);
        document.all[e].focus()
    }

    function setSelectionRange(e, t, n) {
        if (e.setSelectionRange) {
            e.focus();
            e.setSelectionRange(t, n)
        } else if (e.createTextRange) {
            var r = e.createTextRange();
            r.collapse(true);
            r.moveEnd("character", n);
            r.moveStart("character", t);
            r.select()
        }
    }

    function replaceSelection(e, t) {
        if (e.setSelectionRange) {
            var n = e.selectionStart;
            var r = e.selectionEnd;
            e.value = e.value.substring(0, n) + t + e.value.substring(r);
            if (n != r) {
                setSelectionRange(e, n, n + t.length)
            } else {
                setSelectionRange(e, n + t.length, n + t.length)
            }
        } else if (document.selection) {
            var i = document.selection.createRange();
            if (i.parentElement() == e) {
                var s = i.text == "";
                i.text = t;
                if (!s) {
                    i.moveStart("character", -t.length);
                    i.select()
                }
            }
        }
    }

    function catchTab(e, t) {
        if (navigator.userAgent.match("Gecko")) {
            c = t.which
        } else {
            c = t.keyCode
        } if (c == 9) {
            var n = e.scrollTop;
            replaceSelection(e, String.fromCharCode(9));
            stopEvent(t);
            e.scrollTop = n;
            return false
        }
    }

    function stopEvent(e) {
        if (e.preventDefault) {
            e.preventDefault()
        }
        if (e.stopPropagation) {
            e.stopPropagation()
        }
        e.stopped = true
    }

    var js = {
        text: {
            lines: function (e) {
                return this.getLines(e).length
            },
            getLines: function (e) {
                var t = e.split("\n");
                return t
            }
        },
        textElement: {
            value: function (e) {
                return e.value.replace(/\r/g, "")
            },
            caretPosition: function (e) {
                var t = {};
                if (document.selection) {
                    var n = document.selection.createRange();
                    var r = document.body.createTextRange();
                    r.moveToElementText(e);
                    var i;
                    for (i = 0; r.compareEndPoints("StartToStart", n) < 0; i++) {
                        r.moveStart("character", 1)
                    }
                    t.start = i;
                    t.end = i + n.text.replace(/\r/g, "").length
                } else if (e.selectionStart || e.selectionStart == 0) {
                    t.start = e.selectionStart;
                    t.end = e.selectionEnd
                }
                return t
            },
            setCaretPosition: function (e, t) {
                e.focus();
                if (e.setSelectionRange) {
                    e.setSelectionRange(t.start, t.end)
                } else if (e.createTextRange) {
                    var n = e.createTextRange();
                    n.moveStart("character", t.start);
                    n.moveEnd("character", t.end);
                    n.select()
                }
            }
        }
    };

    function highlight(e) {
        var t = js.textElement.caretPosition(e);
        if (!t.start && !t.end) return;
        var n = js.text.getLines(js.textElement.value(e));
        var r = 0,
            i = 0;
        var s = "";
        var o = false;
        var u = 0;
        for (var a in n) {
            i = r + n[a].length;
            if (t.start >= r && t.start <= i) o = true;
            if (o) {
                var f = n[a].substr(0, 11) == "!highlight!";
                if (!u) {
                    if (f) u = 1;
                    else u = 2
                }
                if (u == 1 && f) n[a] = n[a].substr(11, n[a].length - 11);
                else if (u == 2 && !f) s += "!highlight!"
            }
            s = s + n[a] + "\n";
            if (t.end >= r && t.end <= i) o = false;
            r = i + 1
        }
        e.value = s.substring(0, s.length - 1);
        var l = t.start + (u == 1 ? -11 : 11);
        js.textElement.setCaretPosition(e, {
            start: l,
            end: l
        })
    }

    function togglev() {
        if (document.getElementsByTagName("ol")[0].style.listStyle.substr(0, 4) == "none") {
            document.getElementsByTagName("ol")[0].style.listStyle = "decimal";
        } else {
            document.getElementsByTagName("ol")[0].style.listStyle = "none";
        }
    }

    function getElementsByClassName(e, t) {
        if (e.getElementsByClassName) {
            return e.getElementsByClassName(t)
        } else {
            return function n(e, t) {
                if (t == null) t = document;
                var n = [],
                    r = t.getElementsByTagName("*"),
                    i = r.length,
                    s = new RegExp("(^|\\s)" + e + "(\\s|$)"),
                    o, u;
                for (o = 0, u = 0; o < i; o++) {
                    if (s.test(r[o].className)) {
                        n[u] = r[o];
                        u++
                    }
                }
                return n
            }(t, e)
        }
    }