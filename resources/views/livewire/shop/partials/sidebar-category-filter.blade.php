<div class="single__widget widget__bg">
    <h2 class="widget__title h3">Categories</h2>
    <ul class="widget__categories--menu">
        @foreach($this->categories as $category)
            <li class="widget__categories--menu__list"  wire:key="category-{{ $category->id }}">
                <label class="widget__categories--menu__label d-flex align-items-center">
                    <img class="widget__categories--menu__img"
                         src="{{ $category->image_url }}"
                         alt="{{ $category->name }}">
                    @if($category->children->isNotEmpty())
                        <button type="button" wire:click="toggleCategory({{ $category->id }})" class="border-0 bg-transparent p-0">
                            <svg class="widget__categories--menu__arrowdown--icon {{ $openCategories[$category->id] ?? false ? 'rotate-180' : '' }}"
                                 xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </button>
                    @endif
                    <div class="d-flex align-items-center justify-content-between flex-grow-1">
                        <button type="button"
                                class="widget__categories--menu__text {{ $selectedCategory == $category->id ? 'active fw-bold' : '' }}"
                                wire:click="selectCategory({{ $category->id }})"
                                role="button">
                            {{ $category->name }}
                            <small class="text-muted">({{ $category->children_products_count }})</small>
                        </button>
                    </div>
                </label>
                <ul class="widget__categories--sub__menu {{ $openCategories[$category->id] ?? false ? 'show' : '' }}">
                    @foreach($category->children as $child)
                        <li class="widget__categories--sub__menu--list" wire:key="child-category-{{ $child->id }}">
                            <button wire:click="selectCategory({{ $child->id }})"
                                    class="widget__categories--sub__menu--link d-flex align-items-center {{
                                    $selectedCategory == $child->id ? 'active fw-bold' : '' }}">
                                <img class="widget__categories--sub__menu--img" src="{{ $category->image_url }}" alt="{{ $child->id }}">
                                <span class="widget__categories--sub__menu--text">{{ $child->name }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
