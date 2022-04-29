<div class="c-sidebar-brand" style="background-color:#FFFFFF;border: 3px solid #224d9e">
  <div class="c-sidebar-brand-full">
    <img src="{{ url('/assets/img/tesda-dark.ico') }}" width="50" height="46" alt="Tesda Logo">
    <span style="font-size:1rem;font-weight:900;color:#224d9e;" class="ml-2">TESDA RTC-ILIGAN</span>
  </div>
  <img class="c-sidebar-brand-minimized" src="{{ url('/assets/img/tesda-light.png') }}" width="50" height="46" alt="Tesda Logo">
</div>


  

<ul class="c-sidebar-nav">
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('dashboard.index') }}">
      <i class="cil-speedometer c-sidebar-nav-icon"></i>
      Dashboard
    </a>
  </li>
  @role('admin')
  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('program.index') }}">
      <i class="cil-featured-playlist c-sidebar-nav-icon"></i>
      Program
    </a>
  </li>

  <!-- <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('judges.index') }}">
      <i class="cil-user c-sidebar-nav-icon"></i>
      Judges
    </a>
  </li> -->

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('contestant.index') }}">
      <i class="cil-user-female c-sidebar-nav-icon"></i>
      Contestant
    </a>
  </li>
  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('score.index') }}">
      <i class="cil-list-numbered c-sidebar-nav-icon"></i>
      Score
    </a>
  </li>

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('semi.index') }}">
      <i class="cil-list-rich c-sidebar-nav-icon"></i>
      Selection of Top 6
    </a>
  </li>

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('semi.index') }}">
      <i class="cil-indent-increase c-sidebar-nav-icon"></i>
      Selection of Top 3 (Q And A)
    </a>
  </li>

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('terminal.index') }}">
      <i class="cil-bullhorn c-sidebar-nav-icon"></i>
      Final Round
    </a>
  </li>



  <li class="c-sidebar-nav-title">@lang('System')</li>

 
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
        <i class="cil-people c-sidebar-nav-icon"></i>
        User
      </a>
    </li>
  @endrole

  @role('judge')
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('score.index') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i>
        Score
      </a>
    </li>
  @endrole

  <li class="c-sidebar-nav-item">
    <form action="{{ url('/logout') }}" method="POST"> @csrf 
      <span class="c-sidebar-nav-link logout-link" style="cursor:pointer">
        <i class="cil-account-logout c-sidebar-nav-icon"></i>
        Logout
      </span>
    </form>
  </li>

</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>