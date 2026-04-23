@if(isset($video))
    <div class="col-lg-6 col-md-12 h-100" style="padding-left: 0;">
        <div class="video-container">
            <iframe 
                src="{{ $video->link }}" 
                title="YouTube video player" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
@endif