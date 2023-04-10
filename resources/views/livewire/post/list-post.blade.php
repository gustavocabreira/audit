<div>
    @foreach($posts as $post)
        <article
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 flex align-items-center justify-between">
            <div>
                <h1>{{ucfirst($post->title)}}</h1>
                <h6>
                    Created by <span class="text-green-300 font-semibold">{{$post?->author?->name}}</span>
                    and published at <span>{{$post->published_at->format('Y/m/d')}}</span>
                </h6>
            </div>

            <div>
                @can('update', $post)
                    <button type="button" class="bg-orange-500 px-2 py-2 text-white uppercase ml-2">Update</button>
                @endcan
                @can('delete', $post)
                    <button type="button" class="bg-red-500 px-2 py-2 text-white uppercase ml-2">Delete</button>
                @endcan
            </div>
        </article>
    @endforeach
    @if($scheduledPosts->count())
        <div class="max-w-7xl mb-3 mt-6">
            <p class="text-white font-medium text-xl">Scheduled posts</p>
        </div>
        @foreach($scheduledPosts as $post)
            <article
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 flex align-items-center justify-between">
                <div>
                    <h1>{{ucfirst($post->title)}}</h1>
                    <h6>
                        Created by <span class="text-green-300 font-semibold">{{$post?->author->name}}</span>
                        and published at <span>{{$post->published_at->format('Y/m/d')}}</span>
                    </h6>
                </div>

                <div>
                    @can('update', $post)
                        <button type="button" class="bg-orange-500 px-2 py-2 text-white uppercase ml-2">Update</button>
                    @endcan
                    @can('delete', $post)
                        <button type="button" class="bg-red-500 px-2 py-2 text-white uppercase ml-2">Delete</button>
                    @endcan
                </div>
            </article>
        @endforeach
    @endif
</div>
