<x-dashboard-layout title="Categories" subtitle="Sub title">

    <x-alert title="Title" type="danger" :url="URL::current()">
        <x-slot name="actions">
            <a href="#" class="btn btn-danger">Action Button</a>
        </x-slot>
        My message body
    </x-alert>

    <div class="table-toolbar mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-info">Create</a>
    </div>

    <form action="{{ URL::current() }}" method="get" class="d-flex mb-4">
        <input type="text" name="name" class="form-control me-2" placeholder="Search by name">
        <select name="parent_id" class="form-control me-2">
            <option value="">All Categories</option>
            @foreach ($parents as $parent)
            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent ID</th>
                <th>Created At</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
                <td>{{ $category->parent_name }}</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->status }}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-dashboard-layout>