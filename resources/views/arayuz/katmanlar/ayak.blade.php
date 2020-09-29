    </div>
  </div>
<hr>
<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <ul class="list-inline text-center">
          @php $sosyal = ['facebook', 'twitter', 'github', 'linkedin', 'youtube', 'instagram']; @endphp
          @foreach($sosyal as $sos)
            @if($siteBilgileri -> $sos != null)
              <li class="list-inline-item">
                <a target="_blank" href="http://www.{{$sos}}.com/{{$siteBilgileri -> $sos}}">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-{{$sos}} fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            @endif
          @endforeach
        </ul>
        <p class="copyright text-muted">{{date('Y')}} - {{$siteBilgileri -> site_adi}}<sup>&copy;</sup></p>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('tema')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('tema')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="{{asset('tema')}}/js/clean-blog.min.js"></script>

</body>

</html>
