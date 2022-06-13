
  const call_en = () => {

          if ('speechSynthesis' in window) {
          console.log('Speech recognition supported 😊');
          let msg = new SpeechSynthesisUtterance();
          let synth = window.speechSynthesis;
          let voices = synth.getVoices();
          msg.voice = voices[3];
          msg.volume = 1; // From 0 to 1
          msg.rate = 1.1; // From 0.1 to 10
          msg.pitch = 1; // From 0 to 2
          msg.text = "The Good News Of Salvation, Live Your Life With God. Jesus said, I am the way the truth and the life, no one cometh unto the father but by me. All of us want eternal life and that only God can give, but the question is how? The answer is we must be saved. How is it so? Written below are Bible passages that will help clear up this question. Believe that God exist. John 14 verses 1 to 3. Let not your heart be troubled; ye believe in God believe also in me. In my Father's house are many mansions, if it were not so, I would have told you. I go to prepare a place for you. And if I go and prepare a place for you, I will come again, and receive you unto myself; that where I am, there ye maybe also. Believe that Jesus Christ is the Son of God. John 3 verse 16. For God so loved the world that he gave his only begotten Son that whosoever believeth in him should not perish but have everlasting life. John 14 verse 6. I am the way the truth and the life no one cometh unto the father but by me. Confess with your mouth that Jesus is Lord, he died on the cross and that God raised him from the dead. Romans 10 verse 9. because, if you confess with your mouth that Jesus is Lord and believe in your heart that God raised him from the dead, you will be saved. Confess that you are a sinner. 1 John 1 verses 9 to 10. If we confess our sins, he is faithful and just to forgive us our sins and to cleanse us from all unrighteousness. If we say we have not sinned, we make him a liar, and his word is not in us. Romans 3 verse 10. As it is written, there is none righteous, no, not one; Romans 3 verse 23. For all have sinned , and come short of the glory of God; Mathew 28 verse 18. And Jesus came and spake unto them, saying. All power is given unto me in heaven and in earth. Luke 13 verse 3. I tell you, nay: but, except ye repent, ye shall all likewise perish. Be baptized in water. John 3 verses 3 to 5. Jesus answered him, Truly, truly, I say to you, unless one is born again he cannot see the kingdom of God. Nicodemus said to him, How can a man be born when he is old? Can he enter a second time into his mother’s womb and be born? Jesus answered, Truly, truly, I say to you, unless one is born of water and the Spirit, he cannot enter the kingdom of God. Accept Jesus Christ as your Lord and saviour. Romans 6 verse 23. For the wages of sin is death, but the gift of God is eternal life through Jesus Christ our Lord. Other verses of repentance. Ephesian 4 verse 29, Let no corrupt talk come out of your mouths, but only such as is good for building up, as fits the occasion, that it may give grace to those who hear. Mathew 12 verses 36 to 37. I tell you, on the day of judgement people will give account for every careless word they speak, for by the words you will be justified, and by the words you will be condemn. Galatians 5 verses 19 to 23. Envyings, murders, drunkeness, revellings, and such like; of the which I tell you in before, as I have also told you in time past, that they which do such things shall not inherit the kingdon of God. But the fruit of the spirit is love, joy, peace, longsuffering, gentleness, goodness, faith, meekness, temperance: against such there is no law.";
          // speechSynthesis.speak(msg);

              let pause_button = document.getElementById('pause_button');
              let resume_button = document.getElementById('resume_button')
              let play_button = document.getElementById('play_button')
              let cancel_button = document.getElementById('cancel_button')

              resume_button.classList.add('d-none')
              pause_button.classList.add('d-none')

              pause_button.addEventListener('click', function(e){
                  synth.pause()
                  resume_button.classList.remove('d-none')
                  pause_button.classList.add('d-none')
                  resume_button.classList.add('active')
              })
              resume_button.addEventListener('click', function(e){
                  synth.resume()
                  resume_button.classList.add('d-none')
                  pause_button.classList.add('active')
                  pause_button.classList.remove('d-none')
              })
              cancel_button.addEventListener('click', function(e){
                  synth.cancel()
                  play_button.classList.remove('d-none')
                  resume_button.classList.add('d-none')
                  pause_button.classList.add('d-none')
              })
              play_button.addEventListener('click', function(e){
                  speechSynthesis.speak(msg)
                  play_button.classList.add('d-none')
                  pause_button.classList.remove('d-none')
                  pause_button.classList.add('active')
              })



          } else {
              console.log('Speech recognition not supported 😢');
              // code to handle error
          }
      }
        call_en()
