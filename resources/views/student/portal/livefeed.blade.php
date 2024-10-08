@extends('layouts.student')

@section('content')
<div class="video-container" id="videoContainer">
    <iframe src="https://www.youtube.com/embed/KMYZqb88Wm0?si=6sWLURxCBOBYmXwu&amp;controls=0&enablejsapi=1"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen id="youtube-player"
        style="display:none;"></iframe>
    <div class="overlay hidden" id="overlay"></div>
    <button class="btn btn-primary " id="start-video"><i class="fas fa-video mx-2"></i>View Livestream</button>

    <div class="spinner-border text-primary" role="status" id="spinner" style="display: none;">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="d-flex justify-content-center mb-2">
    <button class="btn btn-primary btn-fullscreen" id="fullscreen" style="display:none;">Fullscreen</button>
</div>


@endsection


@push('styles')
<style>
    .video-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 1rem;
        margin: 2rem auto;
        width: 85vw;
        height: 80vh;
    }

    .video-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* .video-container {
        width: 90vw;
        height: 80vh;
    } */

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.05);
        /* Adjust for visibility */
        z-index: 10;
        /* Ensure it's above the iframe */
        pointer-events: all;
        /* Block clicks */
    }

    .btn-fullscreen {
        z-index: 12;
    }

    .hidden {
        display: none;
    }

    .fullscreen {
        position: fixed;
        /* Make it fullscreen */
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 1000;
        /* Ensure it's above everything */
    }

    .fullscreen .video-container {
        width: 100%;
        height: 100%;
    }

    /* Fullscreen overlay */
    .fullscreen .overlay {
        display: block;
    }

    /* @media (min-width: 768px) {
        .video-container {
            width: 80vw;
            height: 80vh;
        }
    } */
</style>
@endpush

@once
@push('scripts')
<script>
    var player;
    var overlay = document.getElementById('overlay');

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('youtube-player', {
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        $('#start-video').click(function(event) {
            var videoContainer = document.getElementById('videoContainer');
            var iframe = $('#youtube-player');

            player.playVideo();  
            $(this).hide(); 
            $('#spinner').show(); 

            setTimeout(() => {
                $('#youtube-player').show(); // Show the iframe after 1 second
                $('#spinner').hide(); // Hide the spinner
                $('#overlay').removeClass('hidden');
                // Fake fullscreen for the video container
                var requestFullScreen = videoContainer.requestFullscreen || videoContainer.mozRequestFullScreen || videoContainer.webkitRequestFullscreen || videoContainer.msRequestFullscreen;
                if (requestFullScreen) {
                    requestFullScreen.call(videoContainer);
                    videoContainer.addClass('fullscreen'); // Add fullscreen class to the video container
                    
                }    
            }, 3000);
        });

        // Prevent clicks on overlay
        $('#overlay').click(function(event) {
            event.stopPropagation(); 
        });

        // Exit fullscreen when clicking outside or pressing escape
        $(document).on('keydown', function(event) {
            if (event.key === "Escape") {
                $('#videoContainer').removeClass('fullscreen');
                $('#fullscreen').show(); 
                //$('#overlay').addClass('hidden');
            }
        });

        document.addEventListener('fullscreenchange', function() {
            if (!document.fullscreenElement) {
                $('#videoContainer').removeClass('fullscreen');
                $('#fullscreen').show(); 
                //$('#overlay').addClass('hidden'); 
            }
        });

        $('#fullscreen').click(function(event) {
            player.playVideo();
            var requestFullScreen = videoContainer.requestFullscreen || videoContainer.mozRequestFullScreen || videoContainer.webkitRequestFullscreen || videoContainer.msRequestFullscreen;
            if (requestFullScreen) {
                requestFullScreen.call(videoContainer);
                videoContainer.addClass('fullscreen'); // Add fullscreen class to the video container
                
            } 
        });
    }
</script>
@endpush
@endonce