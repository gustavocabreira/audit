<div>
    @foreach($posts as $post)
        <article class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5">
            <h1>{{ucfirst($post->title)}}</h1>
            <h6>
                Created by <span class="text-green-300 font-semibold">{{$post->author->name}}</span>
                and published at <span>{{$post->published_at->format('Y/m/d')}}</span>
            </h6>
        </article>
    @endforeach
    <div class="max-w-7xl mb-3 mt-6">
        <p class="text-white font-medium text-xl">Scheduled posts</p>
    </div>
    @foreach($scheduledPosts as $post)
        <article class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5">
            <h1>{{ucfirst($post->title)}}</h1>
            <h6>
                Created by <span class="text-green-300 font-semibold">{{$post->author->name}}</span>
                and will be published at <span>{{$post->published_at->format('Y/m/d')}}</span>
            </h6>
        </article>
    @endforeach
</div>
