@extends('layouts.student')

@section('content')
<div class="video-container">
    <iframe src="https://www.youtube.com/embed/KMYZqb88Wm0?si=6sWLURxCBOBYmXwu&amp;&enablejsapi=1"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen id="youtube-player" style="display:normal;"></iframe>
    <div class="overlay" style="display:none;"></div>
    <button class="btn btn-primary " id="start-video"><i class="fas fa-video mx-2"></i>View Livestream</button>

    <div class="spinner-border text-primary" role="status" id="spinner" style="display: none;">
        <span class="sr-only">Loading...</span>
    </div>
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
    }

    .video-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }


    .video-container {
        width: 90vw;
        height: 80vh;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        z-index: 1;

    }

    #start-button {
        margin-top: 10px
    }

    @media (min-width: 768px) {
        .video-container {
            width: 80vw;
            height: 80vh;
            margin: rem auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1rem;

        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            z-index: 2;

        }
    }
</style>
@endpush

@once
@push('scripts')
<script>
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player( 'youtube-player', {
            events: { }
        });
    }

    jQuery(document).ready(function(){
        $('.overlay').click(function(event) {
            //event.stopPropagation(); 
        });

        $('#start-video').click(function(event) {
            //$('.overlay').toggle();
            player.playVideo();  
            $(this).hide();
            $('#spinner').show();
            
            iframe = $('#youtube-player');

            var requestFullScreen = iframe.requestFullScreen || iframe.mozRequestFullScreen || iframe.webkitRequestFullScreen;
            if (requestFullScreen) {
                requestFullScreen.bind(iframe)();
            }
            setTimeout(() => {
                $('#youtube-player').show();
                $('#spinner').hide();
                
            }, 4000);

        });
        
    });

    

    
    
  
</script>
@endpush
@endonce