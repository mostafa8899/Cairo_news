$('.subscribtion').click(function(){
  
    if($(this).hasClass('active')) {
      
      $(this).removeClass('active');
      $('.form').removeClass('active');
      
      if($(this).hasClass('free')) {
        $('.family').removeClass('hidden');
        $('.premium').removeClass('hidden');
        $('.free-form').removeClass('hidden');
        $('.free-button').removeClass('active');
      }
      if($(this).hasClass('family')) {
        $('.free').removeClass('hidden');
        $('.premium').removeClass('hidden');
      }
      if($(this).hasClass('premium')) {
        $('.free').removeClass('hidden');
        $('.family').removeClass('hidden');
      }
      
    }
    else {
      $(this).addClass('active');
      
      if($(this).hasClass('free')) {
        $('.family').addClass('hidden');
        $('.premium').addClass('hidden');
        $('.free-form').addClass('hidden');
        $('.free-button').addClass('active');
      }
      if($(this).hasClass('family')) {
        $('.free').addClass('hidden');
        $('.premium').addClass('hidden');
      }
      if($(this).hasClass('premium')) {
        $('.free').addClass('hidden');
        $('.family').addClass('hidden');
      }
      
      $('.form').addClass('active');
    }
    
  });
  
  $('.payment-btn').click(function(){
    
    if( $(this).hasClass('active') ) {
      $(this).removeClass('active');
    }
    else {
      $('.payment-btn').removeClass('active');
      $(this).addClass('active');
    }
    
  })
  const stories = document.querySelector('.stories');
  const prev = document.querySelector('.prev');
  const next = document.querySelector('.next');
  let activeStory = 0;
  
  const setActiveStory = (index) => {
    const storiesArr = Array.from(stories.children);
    storiesArr.forEach((story) => {
      story.classList.remove('active');
    });
    storiesArr[index].classList.add('active');
    activeStory = index;
  };
  
  const nextStory = () => {
    if (activeStory < stories.children.length - 1) {
      setActiveStory(activeStory + 1);
    }
  };
  
  const prevStory = () => {
    if (activeStory > 0) {
      setActiveStory(activeStory - 1);
    }
  };
  
  const init = () => {
    setActiveStory(0);
    next.addEventListener('click', nextStory);
    prev.addEventListener('click', prevStory);
    stories.addEventListener('click', (event) => {
      const storyIndex = Array.from(stories.children).indexOf(event.target.closest('.story'));
      if (storyIndex !== -1) {
        setActiveStory(storyIndex);
      }
    });
  };
  
  init();

  //Share

