<x-guest-layout>
    <!-- Main Hero Content -->
    <div class="container max-w-lg px-4 py-32 mx-auto text-left bg-center bg-no-repeat bg-cover md:max-w-none md:text-center" style="background-image: url('/images/headerim.jpg')">
      <h1 class="font-mono text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-yellow-500 md:text-center sm:leading-none lg:text-5xl">
          <span class="inline md:block">Welcome To SPORTS BOOKING SYSTEM</span>
      </h1>
      <div class="mx-auto mt-2 text-green-50 md:text-center lg:text-lg">
        Your Gateway To A Healthy And Active Lifestyle. Discover The Joy Of Sports, Unleash Your Potential, And Book Your Court Today To Embark On An Exciting Journey Towards A Healthier And More Fulfilling Life.
      </div>
      
      
  </div>
  
    
    <!-- End Main Hero Content -->

    <style>
      .container-bg {
        background-image: url('{{ asset('images/sportbg.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-color: rgba(0, 0, 0, 0.5);
      }
    </style>

<style>
  .bg-opacity-60 {
    background-color: rgba(255, 255, 255, 0.6);
  }
</style>

  <div class="container-bg">

      <div class="flex justify-center mt-4 lg:mt-0">
          @auth
              <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400">
                      Logged In
                  </button>
              </form>
          @endauth
      </div>
  
    <section class="px-2 py-32 bg-opacity-60 md:px-0">
      <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
        <div class="flex flex-wrap items-center sm:-mx-3">
          <div class="w-full md:w-1/2 md:px-3">
            <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pr-0 md:pb-0">
              <!-- <h1
              class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl"
            > -->
              <h3 class="text-xl">Pusat Sukan UiTM Shah Alam
              </h3>
              <h2 class="text-4xl text-green-600">UiTM SHAH ALAM</h2>
              <!-- </h1> -->
              <p class="mx-auto text-base text-white sm:max-w-md lg:text-xl md:max-w-3xl">
                Unleash your sporting passion at UITM Shah Alam's state-of-the-art sports court. Join fellow students in basketball, volleyball, and more, and experience the thrill of competition and 
                camaraderie on our vibrant campus. Stay active, make memories, and be a part of the sports-loving community at UITM Shah Alam.
              </p>
              <div class="relative flex">
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/2">
            <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
              <img src="https://uitm.edu.my/images/images/exploreus/applynow.jpg" />
            </div>
          </div>
        </div>
      </div>
    </section>
    
    

    <section class="mt-8 bg-opacity-60">
      <div class="mt-4 text-center">
        <h3 class="text-2xl font-bold">Our Sports</h3>
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-black">
          All the various sports fields available </h2>
      </div>
      <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
          
          @foreach ($categories as $category)
          <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
              <img class="w-full h-48" src="{{Storage::url($category->image)  }}"
                alt="Image" />
              <div class="px-6 py-4">
                <div class="flex mb-2">
                  <span class="px-4 py-0.5 text-sm bg-pink-500 rounded-full text-pink-50"></span>
                </div>

              <a href="{{ route('categories.show',$category->id) }}">
                  <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">{{ $category->name }}</h4>
              </a>
                
              
              </div>
             
            </div>
          @endforeach

        </div>
      </div>
    </section>

    <section class="pt-4 pb-12 bg-gray-50">
      <div class="my-8 text-center">
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
          Court Gallery</h2>
        <p class="text-xl">Game on! The Sports Court: Where champions are made, sweat is earned, and the spirit of competition comes alive</p>
      </div>
      <div class="container grid gap-4 mx-auto lg:grid-cols-3">
        <div class="w-full rounded">
          <img src="{{ asset('images/brr.jpg') }}" alt="image" class="object-cover w-full h-56 lg:h-80">
        </div>
        <div class="w-full rounded">
          <img src="{{ asset('images/brr2.jpg') }}" alt="image" class="object-cover w-full h-56 lg:h-80">
        </div>
        <div class="w-full rounded">
          <img src="{{ asset('images/brr3.jpg') }}" alt="image" class="object-cover w-full h-56 lg:h-80">
        </div>
        <div class="w-full rounded">
          <img src="{{ asset('images/bb1.jpg') }}" alt="image" class="object-cover w-full h-56 lg:h-80">
        </div>
        <div class="w-full rounded">
          <img src="{{ asset('images/vb6.jpg') }}" alt="image" class="object-cover w-full h-56 lg:h-80">
        </div>
        <div class="w-full rounded">
          <img src="{{ asset('images/tennis.jpg') }}" alt="image" class="object-cover w-full h-56 lg:h-80">
        </div>
      </div>
    </section>

    <section class="py-10 bg-gray-50">
      <div class="container max-w-3xl px-4 mx-auto">
        <h2 class="mb-2 text-xl font-semibold">Need Assistance?</h2>
        <p class="mb-2 text-sm text-gray-500">Contact our administrator, Encik Naufal at +60 13-327-1234</p>
      </div>
    </section>
    
    

  
  </div>
</x-guest-layout>
 
