<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <img src="https://icon-library.com/images/english-icon-png/english-icon-png-21.jpg" width="30"
                         height="30" class="d-inline-block align-top" alt="">
                    Bootstrap
                </a>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link :to="{name:'word'}" class="nav-link text-light">Головна</router-link>
                        </li>

                        <li class="nav-item">
                            <router-link :to="{name:'grammar'}" class="nav-link text-light">Граматика</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name:'irregular_verbs'}" class="nav-link text-light">Таблиця неправильних дієслів</router-link>
                        </li>
                        <li class="nav-item" v-if="role === 'admin'">
                            <router-link :to="{name:'admin'}" class="nav-link text-light">Admin</router-link>
                        </li>

                    </ul>
                    <!--                <span class="navbar-text">-->
                    <!--                        @guest-->
                    <!--                            @if (Route::has('login'))-->
                    <!--                                <li class="nav-item">-->
                    <!--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>-->
                    <!--                                </li>-->
                    <!--                            @endif-->

                    <!--                            @if (Route::has('register'))-->
                    <!--                                <li class="nav-item">-->
                    <!--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>-->
                    <!--                                </li>-->
                    <!--                            @endif-->
                    <!--                        @else-->
                    <!--                            -->
                    <!--                                <a id="navbarDropdown" class="" href="#" role="button" style="text-decoration: none;"-->
                    <!--                                >-->
                    <!--                                    {{ Auth::user()->name }}-->
                    <!--                                </a>-->
                    <!--                            -->
                    <!--                                <a   href="{{ route('logout') }}" onclick="event.preventDefault();-->
                    <!--                                                     document.getElementById('logout-form').submit();">-->
                    <!--                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">-->
                    <!--                                        <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>-->
                    <!--                                      </svg>-->
                    <!--                                </a>-->

                    <!--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">-->
                    <!--                                    @csrf-->
                    <!--                                </form>-->
                    <!--                           -->

                    <!--                        @endguest-->
                    <!--                    </span>-->
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: "NavBar",
    data(){
        return{
            role: document
                .querySelector("meta[name='role']")
                .getAttribute("content"),
        }
    }
}
</script>

<style scoped>

</style>
