// $(document).ready(function() {
//     $( ".language" ).on( "click", clickLanguage);
// });

function selectLanguage(lang) {
    var ptImgLink = "/images/lang/pt-BR.svg";
    var enImgLink = "/images/lang/en.svg";
    var esImgLink = "/images/lang/es.svg";

    var imgBtnSel = $('#imgBtnSel');
    var imgBtnPt = $('#imgBtnPt');
    var imgBtnEn = $('#imgBtnEn');
    var imgBtnEs = $('#imgBtnEs');

    var imgNavSel = $('#imgNavSel');
    var imgNavPt = $('#imgNavPt');
    var imgNavEn = $('#imgNavEn');
    var imgNavEs = $('#imgNavEs');

    var spanNavSel = $('#lanNavSel');
    var spanBtnSel = $('#lanBtnSel');

    imgBtnSel.attr("src",ptImgLink);
    imgBtnPt.attr("src",ptImgLink);
    imgBtnEn.attr("src",enImgLink);
    imgBtnEs.attr("src",esImgLink);

    imgNavSel.attr("src",ptImgLink);
    imgNavPt.attr("src",ptImgLink);
    imgNavEn.attr("src",enImgLink);
    imgNavEs.attr("src",esImgLink);

    var currentId = $(this).attr('id');

    if(lang == "pt") {
        imgNavSel.attr("src",ptImgLink);
        spanNavSel.text("PT-BR");
    } else if (lang == "en") {
        imgNavSel.attr("src",enImgLink);
        spanNavSel.text("ENG");
    } else if (lang == "es") {
        imgNavSel.attr("src",esImgLink);
        spanNavSel.text("ESP");
    }

    
}