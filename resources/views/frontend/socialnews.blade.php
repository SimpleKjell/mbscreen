

  <div class="social-news-container pt-3 pb-3">

    <div class="container  social-news-container-inner">

      @if($lists)

        <div class="row">
          @foreach($lists as $list)
            <div class="col">
              <div class="list-header">
                <div class="card">
                  <div class="card-body">
                    <b>{{$list['name']}}</b>
                  </div>
                </div>
              </div>
              @if($list['cards'])
                @foreach($list['cards'] as $card)

                <div class="card list-item-container marginTopMedium">
                  @if($card['picture'])
                  <img class="card-img-top list-item-picture" src="{{$card['picture']}}">
                  @endif
                  <div class="card-body">
                    <p class="card-text">{{$card['name']}}</p>
                  </div>
                </div>
                @endforeach

              @endif

            </div>
          @endforeach
        </div>

      @endif

    </div>
  </div>
