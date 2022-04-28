<div class="c-sidebar-brand">
  <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/coreui-base-white.svg') }}" width="118" height="46" alt="CoreUI Logo">
  <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/coreui-signet-white.svg') }}" width="118" height="46" alt="CoreUI Logo">
</div>
<ul class="c-sidebar-nav">
  @role('admin')
  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('program.index') }}">
      <i class="cil-speedometer c-sidebar-nav-icon"></i>
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
      <i class="cil-speedometer c-sidebar-nav-icon"></i>
      Contestant
    </a>
  </li>
  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('score.index') }}">
      <i class="cil-speedometer c-sidebar-nav-icon"></i>
      Score
    </a>
  </li>

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('program.index') }}">
      <i class="cil-speedometer c-sidebar-nav-icon"></i>
      Selection of Top 6
    </a>
  </li>

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('program.index') }}">
      <i class="cil-speedometer c-sidebar-nav-icon"></i>
      Selection of Top 3 (Q And A)
    </a>
  </li>

  <li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('program.index') }}">
      <i class="cil-speedometer c-sidebar-nav-icon"></i>
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