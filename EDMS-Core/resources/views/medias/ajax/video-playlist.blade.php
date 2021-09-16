<input type="hidden" class="category" value='{{$category}}' />
<input type="hidden" id="searchUrl" value="{{route('documents.playlist')}}" />

<hr>
 <div class="list similar-videos" style="margin-top: 30px;overflow-x: hidden;">
                <div class="row">
                <div class="col-md-10 col-md-offset-1">
                @if(count($document_editions)>0)
                @foreach($document_editions as $document_edition)
                            <div class="col-lg-3 col-xs-12 col-sm-6 videoitem" style="margin-bottom: 30px">
                                <div class="b-video">
                                    <div class="v-img">
                                         <a href="{{route('documents.play', $document_edition->id)}}"><img src="{{asset('circle_video_sharing/images/small-'.$document_edition->document->category.'-placeholder.png')}}" alt="" style="width: 100%"></a>
                                    </div>
                                    <div class="v-desc">
                                       <a href="{{route('documents.play', $document_edition->id)}}">{{$document_edition->document->title}}</a>
                                    </div>
                                    <div class="v-views">
                                        {{$document_edition->view_count}} {{App\Global_var::getLangString('Views', $language_strings)}}
                                    </div>
                                </div>
                            </div>
                @endforeach 
                @else
                <h3><center>
                    {{App\Global_var::getLangString('No_Result_Found', $language_strings)}}
                </center></h3>
                @endif 
            </div>
        </div>
    </div>

<div class="col-xs-12">
    <center>{{$documents->links()}}</center>
</div>

    <hr>