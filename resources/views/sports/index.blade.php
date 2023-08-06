<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($sports as $sport)
            <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                <img class="w-full h-48" src="{{Storage::url($sport->image)  }}"
                  alt="Image" />
                <div class="px-6 py-4">
                  <div class="flex mb-2">
                    <span class="px-4 py-0.5 text-sm bg-pink-500 rounded-full text-pink-50"></span>
                  </div>
  
                
                    <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">{{ $sport->name }}</h4>
                
                  
                  <p class="leading-normal text-gray-700">{{ $sport->description }}</p>
                </div>
               
              </div>
            @endforeach

        </div>
      </div>
</x-guest-layout>