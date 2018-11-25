/* "TO TOP" START */
$('body').append('<div id="toTop" class="btn btn-primary"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>');
$(window).scroll(function() {
    if ($(this).scrollTop() != 0) {
        $('#toTop').fadeIn();
    } else {
        $('#toTop').fadeOut();
    }
});
$('#toTop').click(function() {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});
$(".nav a").click(function() {
    if ($(".navbar-collapse").hasClass("in")) {
        $('[data-toggle="collapse"]').click();
    }
});

/* kennwort im formular anzeigen oder verstecken */
$(document).ready(function() {
    $('.pass_show').append('<span class="ptxt">Show</span>');
});
$(document).on('click', '.pass_show .ptxt', function() {
    $(this).text($(this).text() == "Show" ? "Hide" : "Show");
    $(this).prev().attr('type', function(index, attr) { return attr == 'password' ? 'text' : 'password'; });
});

// EINBLENDUNG DER HINWEISE OBEN IM HEADER => footer.tpl
$(document).ready(function() {
    $("#hint").fadeIn(3000).delay(5000).fadeOut(3000);
    $("#text").fadeIn(3000).delay(5000).fadeOut(3000);
});

/* HEADER NAV NACH OBEN VERSTECKEN START */
var lastScrollTop = 0;
$(window).scroll(function(event) {
    var st = $(this).scrollTop();
    if (st > lastScrollTop) {
        if (!$('body').hasClass('down')) {
            $('body').addClass('down');
        }
    } else {
        $('body').removeClass('down');
    }

    lastScrollTop = st;

    if ($(this).scrollTop() <= 0) {
        $('body').removeClass('down');
    };
});

// autocomplete deaktivieren
$(document).ready(function() {
    $("#search").attr('autocomplete', 'off');
});
$(document).ready(function() {
    $("#name").attr('autocomplete', 'off');
});
$(document).ready(function() {
    $("#password").attr('autocomplete', 'off');
});
$(document).ready(function() {
    $("#password2").attr('autocomplete', 'off');
});
$(document).ready(function() {
    $("#recover").attr('autocomplete', 'off');
});

// username prüfen ob bereits vergeben
function check_username(inhalt) {
    if (inhalt == "") {
        document.getElementById("check_username").innerHTML = "<div class='alert-info alert-username'>Keine Eingabe</div>";
        return;
    }
    if (window.XMLHttpRequest) {
        // AJAX nutzen mit IE7+, Chrome, Firefox, Safari, Opera
        xmlhttp = new XMLHttpRequest();
    } else {
        // AJAX mit IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("check_username").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "/api/username.php?q=" + inhalt, true);
    xmlhttp.send();
}

// passwort sicherheit prüfen
function passwordsecurity(inhalt) {
    if (inhalt == "") {
        document.getElementById("passwordsecurityhint").innerHTML = "<div class='alert-info alert-password'>Keine Eingabe</div>";
        return;
    }
    if (window.XMLHttpRequest) {
        // AJAX nutzen mit IE7+, Chrome, Firefox, Safari, Opera
        xmlhttp = new XMLHttpRequest();
    } else {
        // AJAX mit IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("passwordsecurityhint").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "/api/password.php?q=" + inhalt, true);
    xmlhttp.send();
}