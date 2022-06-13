import FlashScript from "../../../flash.js";

const picker = new FlashScript()
document.querySelectorAll('.px-3').forEach(item => {
  item.addEventListener('click', function(){
    picker.picker(item)
  })
})


  $(function(){
    $('.fg.mb-3>span').addClass('bg-info');
    $('.sg.mb-3>span').addClass('bg-warning');
    $('.tg.mb-3>span').addClass('bg-success');

    $('#small').on('click', function(){
        $('#first').removeClass('text-uppercase')
        $('#second').removeClass('text-uppercase')
        $('#third').removeClass('text-uppercase')

        $('#first').addClass('text-lowercase')
        $('#second').addClass('text-lowercase')
        $('#third').addClass('text-lowercase')

        let x= document.querySelector('#two_letter_word')
        if(x.classList.contains('d-none'))
            $(".disp_cov").css({"max-width": "253px"})
        else{
            $(".disp_cov").css({"max-width": "337px"})
        }

    })
    $('#capital').on('click', function(){
        $('#first').removeClass('text-lowercase')
        $('#second').removeClass('text-lowercase')
        $('#third').removeClass('text-lowercase')

        $('#first').addClass('text-uppercase')
        $('#second').addClass('text-uppercase')
        $('#third').addClass('text-uppercase')

        let  x= document.querySelector('#two_letter_word')
        if(x.classList.contains('d-none'))
            $(".disp_cov").css({"max-width": "271px"})
        else{
            $(".disp_cov").css({"max-width": "389px"})
         }
      })

    $('#two_letter_word').on('click', function(){
        $('#titem').hide()
        let x= document.querySelector('#first')
        if(x.classList.contains('text-uppercase'))
            $(".disp_cov").css({"max-width": "285px"})
        else{
            $(".disp_cov").css({"max-width": "253px"})
        }

        $('.tg.mb-3').hide()
        $('#two_letter_word').removeClass('d-block')
        $('#two_letter_word').addClass('d-none')
    })

     $('#clear').on('click', function(){
       $('#first').text('')
       $('#second').text('')
       $('#third').text('')
     })


     var fg = document.querySelector('.fg')
     var sg = document.querySelector('.sg')
     var tg = document.querySelector('.tg')
     if(window.matchMedia("(max-width:600px)").matches){
       fg.style.maxWidth = '360px'
       sg.style.maxWidth = '360px'
       tg.style.maxWidth = '360px'
     }

     $('#arrow_down').on('click', function(){
       $('#option').hide()
       $(this).hide()
       $('#arrow_up').removeClass('d-none')
     })
     $('#arrow_up').on('click', function(){
       $('#option').slideToggle()
       $('#arrow_down').show()
       $('#arrow_up').addClass('d-none')
     })
})
