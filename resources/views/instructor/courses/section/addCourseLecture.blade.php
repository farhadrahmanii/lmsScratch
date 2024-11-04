@extends('instructor.instructorDashboard')
@section('instructor')


<!-- Jquery is loaded Here  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="row">
        <div class="col-12">

            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{asset($course->course_image)}}" class="rounded-circle p-1 border" width="90"
                            height="90" alt="...">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">{{ $course->course_title}}</h5>
                            <p class="mb-0">{{ $course->description }}</p>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add Section</button>
                        <!-- Modal -->
                    </div>
                </div>
            </div>


            <!-- add Section and Lectures -->
            @foreach ($courseSection as $key => $sections)
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <h5>{{$sections->section_title}}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <form action="{{ route('delete.section', ['id' => $sections->id]) }}" method="POST">
                                            @csrf
                                            <x-forms.button type="submit" class="btn btn-danger">Delete
                                                Section</x-forms.button>&nbsp;
                                        </form>
                                        <x-forms.button class="btn btn-primary"
                                            onclick="addLectureDiv({{ $course->id }}, {{ $sections->id }}, 'lectureContainer{{ $key }}')"
                                            id="addLectureBtn({{ $key }})" data-bs-toggle="modal">Add
                                            Lecture</x-forms.button>

                                    </div>
                                </div>
                                <div class="courseHide" id="lectureContainer{{$key}}">
                                    <div class="container">
                                        @foreach ($sections->lectures as $lecture)

                                            <div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
                                                <div>
                                                    {{ $loop->iteration }}. {{$lecture->lecture_title}}
                                                </div>
                                                <div class="btn-group">
                                                    <a href="{{route('edit.lecture', ['id' => $lecture->id])}}"
                                                        class="btn btn-sm btn-primary">Edit</a>&nbsp;
                                                    <a href="{{route('delete.lecture', ['id' => $lecture->id])}}"
                                                        class="btn btn-sm btn-danger" id="delete">Delete</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach














        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{route('add.course.section')}}">
                @csrf
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <input type="hidden" name="course_id" value="{{ $course->id }}" />
                <div class="modal-body">
                    <x-forms.input name="section_title" class="form-control" label="Section Title" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <div class="d-flex">
    <h6><strong>Lecture Title</strong></h6>
    <x-forms.input name="lecture_title" label="Lecture Title" placeholder="Lecture Title" />
    <textarea name="lecture_name" class="form-control mt-2" placeholder="Lecture Content"></textarea>
    <h6 class="mt-3">Add Video URL</h6>
    <x-forms.input name="url" label="Video URL" placeholder="Video URL" />
    <div class="btn-group">
        <a href="" class="btn btn-sm btn-primary">Save Lecture</a>&nbsp;
        <a href="" class="btn btn-sm btn-danger" onclick="hideLectureContainer('${containerId})">Cancel</a>
    </div>
</div> -->

<script>
    function addLectureDiv(courseId, sectionId, containerId) {
        const lectureContainer = document.getElementById(containerId);
        // if (lectureContainer) {
        //     lectureContainer.classList.toggle('courseHide');
        // }
        const newLectureDiv = document.createElement('div');
        newLectureDiv.classList.add('lectureDiv', 'mb-3');
        newLectureDiv.innerHTML = `
            <div class="container ">
                <x-forms.input name="lecture_title" label="Lecture Title" placeholder="Lecture Title" />
                <textarea name="lecture_name" class="form-control mt-2" placeholder="Lecture Content"></textarea>

                <x-forms.input name="url" label="Video URL" placeholder="Video URL" />
                <div class="btn-group my-2">
                    <button type="submit" class="btn btn-sm btn-primary" onClick="saveLecture('${courseId}',${sectionId},'${containerId}')">Save Lecture</button>&nbsp;
                    <a href="" class="btn btn-sm btn-danger" onclick="hideLectureContainer('${containerId})">Cancel</a>
                 </div>
            </div>
        `;
        lectureContainer.appendChild(newLectureDiv);

        function hideLectureContainer(containerId) {
            const lectureContainer = document.getElementById(containerId);
            lectureContainer.style.display = 'none';
            location.reload();
        }

        // Make an AJAX request to fetch the lectures for the selected section
        // $.ajax({
        //     url: '/add-course-lecture/' + courseId + '/' + sectionId,
        //     type: 'GET',
        //     success: function (data) {
        //         // Clear the existing content of the container
        //         $('#' + containerId).empty();

        //         // Append the fetched lectures to the container
        //         $.each(data, function (index, lecture) {
        //             var lectureDiv = '<div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">' +
        //                 '<div>' +
        //                 '<strong>Lecture Title</strong>' +
        //                 '</div>' +
        //                 '<div class="btn-group">' +
        //                 '<a href="" class="btn btn-sm btn-primary">Edit</a>&nbsp;' +
        //                 '<a href="" class="btn btn-sm btn-danger">Delete</a>' +
        //                 '</div>' +
        //                 '</div>';

        //             $('#' + containerId).append(lectureDiv);
        //         });
        //     },
        //     error: function (xhr, status, error) {
        //         console.error(xhr.responseText);
        //     }
        // });
    }
    function saveLecture(courseId, sectionId, containerId) {
        const lectureContainer = document.getElementById(containerId);
        const lectureTitle = lectureContainer.querySelector('input[name="lecture_title"]').value;
        const lectureContent = lectureContainer.querySelector('textarea').value;
        const lectureUrl = lectureContainer.querySelector('input[name="url"]').value;

        fetch('/save-lecture', {  // Corrected fetch syntax here
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                course_id: courseId,
                section_id: sectionId,
                lecture_title: lectureTitle,
                content: lectureContent,
                url: lectureUrl,
            })
        })
            .then(response => response.json())
            .then(data => {
                lectureContainer.style.display = 'none';
                location.reload();
                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 6000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        title: data.error,
                    })
                }

                // End Message 
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
@endsection