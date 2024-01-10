function addSection()
     {
        const originalSection = document.querySelector('[name="sectionTitle[]"]');
        const dynamicSectionsContainer = document.getElementById('dynamicSectionsContainer');
        dynamicSectionsContainer.style.border = '2px solid';
        dynamicSectionsContainer.style.padding = '30px';

        const newSection = originalSection.cloneNode(true);
        newSection.value = '';  
        newSection.classList.add('dynamic-section');
        var br1 = document.createElement("br");
        var br2 = document.createElement("br");

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete Section';
        deleteButton.classList.add('delete-button');
        deleteButton.onclick = function () {
        dynamicSectionsContainer.removeChild(newSection);
        dynamicSectionsContainer.removeChild(deleteButton);
        dynamicSectionsContainer.style.border = 'none';
        dynamicSectionsContainer.style.padding = '0';
        };

        const lectureContainer = document.createElement('div');
        lectureContainer.classList.add('dynamic-section');
        lectureContainer.id = `dynamicSectionsContainer${dynamicSectionsContainer.childElementCount}`;
    
        dynamicSectionsContainer.appendChild(newSection);
        dynamicSectionsContainer.appendChild(br1);
        dynamicSectionsContainer.appendChild(br2);
        dynamicSectionsContainer.appendChild(deleteButton);
        dynamicSectionsContainer.appendChild(lectureContainer);

        addLecture(dynamicSectionsContainer.childElementCount - 1);
    }

        function addContent(sectionIndex) 
        {
            var videoContainer = $('#dynamicSectionsContainer' + sectionIndex + ' .video-container');
            var existingVideoInput = videoContainer.find('input[type="file"]');

            if (!existingVideoInput.length) {
                var videoInput = $('<input>').attr({
                    type: 'file',
                    name: 'video[' + sectionIndex + '][]',
                    accept: 'video/*',
                    required: true
                });

                videoContainer.append(videoInput);
                videoContainer.slideDown();
            } else {
                existingVideoInput.slideToggle();
                videoContainer.slideToggle();
            }
        }

            function addDescription(sectionIndex) {
            var descriptionContainer = $('#dynamicSectionsContainer' + sectionIndex + ' .description-container');
            var existingDescriptionInput = descriptionContainer.find('input[type="text"]');

            if (!existingDescriptionInput.length) {
                var descriptionInput = $('<input>').attr({
                    type: 'text',
                    name: 'lectureDescription[' + sectionIndex + '][]',
                    placeholder:"Enter the description",
                    required: true
                });

                descriptionContainer.append(descriptionInput);
                descriptionContainer.slideDown();
            } else {
                existingDescriptionInput.slideToggle();
                descriptionContainer.slideToggle();
            }
        }

        function addLecture(sectionIndex) 
        {
            var dynamicSectionsContainer = $('#dynamicSectionsContainer' + sectionIndex);
            var lectureIndex = dynamicSectionsContainer.children('.dynamic-lecture-details').length;

            // Create a container for lecture details
            var lectureDetailsContainer = $('<div>').addClass('dynamic-lecture-details');

            // Clone the original lecture inputs
            var originalLectureTitle = $('[name="lectureTitle[' + sectionIndex + '][]"]');
            var newLectureTitle = originalLectureTitle.clone().val('').addClass('dynamic-lecture').attr('name', 'lectureTitle[' + sectionIndex + '][' + lectureIndex + ']');

            // Clone the original lecture description input
            var originalLectureDescription = $('[name="lectureDescription[' + sectionIndex + '][]"]');
            var newLectureDescription = originalLectureDescription.clone().val('').addClass('dynamic-lecture').attr('name', 'lectureDescription[' + sectionIndex + '][' + lectureIndex + ']');

            // Clone the original lecture video input
            var originalLectureVideo = $('[name="video[' + sectionIndex + '][]"]');
            var newLectureVideo = originalLectureVideo.clone().val('').addClass('dynamic-lecture').attr('name', 'video[' + sectionIndex + '][' + lectureIndex + ']').css('display', 'none');

            // Create a content button for the lecture
            var newLectureContentButton = $('<button>').text('+ Content').click(function () {
                // Toggle the visibility of the video upload option for the lecture
                newLectureVideo.toggle();
            });
        
            // Create delete buttons for the lecture
            var deleteButton = $('<button>').text('Delete Lecture').addClass('delete-button').click(function () {
                lectureDetailsContainer.remove();

                // Hide the original video container if there are no more lectures
                var originalVideoContainer = $('#videoContainer' + sectionIndex);
                var dynamicLectureContainers = dynamicSectionsContainer.children('.dynamic-lecture-details');
                originalVideoContainer.css('display', dynamicLectureContainers.length === 0 ? 'none' : 'block');
            });

            // Append the lecture inputs and delete button to the lecture details container
            lectureDetailsContainer.append(document.createElement("br"),newLectureTitle,document.createElement("br"),newLectureDescription,document.createElement("br"),document.createElement("br"), newLectureContentButton, newLectureVideo,deleteButton);

            // Append the lecture details container to the dynamic sections container
            dynamicSectionsContainer.append(lectureDetailsContainer);

            // Hide the original video container after adding a lecture
            var originalVideoContainer = $('#videoContainer' + sectionIndex);
            originalVideoContainer.css('display', 'none');
        }

        function addCurriculum() 
        {
          var curriculumContent = document.getElementById('curriculum-content');
          var addLectureButton = $('#addLectureButton');
          var addQuizButton = $('#addQuizButton');

          if (addLectureButton.length && addQuizButton.length)
           {
          addLectureButton.slideToggle();
          addQuizButton.slideToggle();
           } else 
           {
            addLectureButton = document.createElement('button');
            addLectureButton.textContent = '+ Lecture';
            addLectureButton.id = 'addLectureButton';
            addLectureButton.type = 'button';
            addLectureButton.onclick = function () {
            addLecture(0);
            };

            addQuizButton = document.createElement('button');
            addQuizButton.textContent = '+ Quiz';
            addQuizButton.id = 'addQuizButton';
            addQuizButton.type = 'button';
            addQuizButton.onclick = function () {
            createQuizSection(0);
            };

            curriculumContent.appendChild(addLectureButton);
            curriculumContent.appendChild(addQuizButton);
           }
        }
        var quizContainerVisible = false;
        function createQuizSection()
        {
            var quizContainer = document.getElementById('quizContainer');
            quizContainer.style.display = quizContainerVisible ? 'none' : 'block';
            quizContainerVisible = !quizContainerVisible;

        }
        
    function addQuestion() 
    {
         var container = document.getElementById("questionContainer");
         var questionDiv = document.createElement("div");
        questionDiv.className = "question";

        var input = document.createElement("input");
        input.type = "text";
        input.name = "questions[]";
        input.placeholder = "Enter Question";
        input.required = true;

        questionDiv.appendChild(input);

        var answerContainer = document.createElement("div");
        answerContainer.className = "answerContainer";
        questionDiv.appendChild(answerContainer);

        var br1 = document.createElement("br");
        questionDiv.appendChild(br1);

        var button = document.createElement("button");
        button.type = "button";
        button.textContent = "Add Answer";
        button.onclick = function () {
        var questionIndex = document.querySelectorAll('.question').length - 1;
        addAnswer(questionIndex);
        };
        questionDiv.appendChild(button);

        var br2 = document.createElement("br");
        questionDiv.appendChild(br2);

        container.appendChild(questionDiv);
    }


    function addAnswer(questionIndex)
     {
        var container = document.querySelectorAll('.question')[questionIndex].querySelector(".answerContainer");

        var radio = document.createElement("input");
        radio.type = "radio";
        radio.name = "correct_answer[" + questionIndex + "]";
        radio.value = container.querySelectorAll('input[type="radio"]').length; 
        radio.required = true;

        var inputTitle = document.createElement("input");
        inputTitle.type = "text";
        inputTitle.name = "answers[" + questionIndex + "][title][]";
        inputTitle.placeholder = "Enter Answer";
        inputTitle.required = true;

        var br1 = document.createElement("br");
        var br2 = document.createElement("br"); 


        var inputDescription = document.createElement("input");
        inputDescription.type = "text";
        inputDescription.name = "answers[" + questionIndex + "][description][]";
        inputDescription.placeholder = "Enter Answer Description";
        inputDescription.required = true;

        var br3 = document.createElement("br"); 

        inputDescription.style.marginLeft = "25px";

        var br4 = document.createElement("br"); 

        container.appendChild(radio);
        container.appendChild(inputTitle);
        container.appendChild(br1);
        container.appendChild(br2);
        container.appendChild(inputDescription);
        container.appendChild(br3);
        container.appendChild(br4);
    }

    function toggleQuizContainer() {
            var quizContainer = document.getElementById('quizContainer');
            quizContainer.style.display = quizContainer.style.display === 'none' ? 'block' : 'none';
        }
    