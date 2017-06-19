# Query Builder Documentation
This Query Builder just like Laravel's framework.

# - Retrieving Results
##### Retrieving All Rows From A Table
You may use the `table` method on the `DB` class to begin the query.
```php
$users = DB::table('users')->get();
```
Access the Collection:
```php
foreach ($users as $user):
    echo $user->username;
endforeach;
```
##### Retrieving A Single Row / Column From A Table
You may just want to retrieve some single record:
```php
$users = DB::table('users')->select('username','roles')->first();
```
Then access it suddenly:
```php
echo $users->username;
echo $users->email;
```

##### Aggregrates
Just like Laravel, you may use Aggregrates methods such as `count`,`max`,`min`,`avg`:
```php
$users = DB::table('users')->count(); // return number of record
```
Of course, you may combine it with others method:
```php
$users = DB::table('users')
    ->where('role_id','1')
    ->avg('votes');
```
```php
$users = DB::table('users')
    ->select('username','email')
    ->max('votes');
```

# - Selects
##### Specifying A Select Clause
You may just needs some column:
```php
$users = DB::table('users')
    ->select('name', 'email as user_email')
    ->get();
```

# - Joins
##### Inner Join Clause
The Query Builder may also perform basic Join Clause and make your work easier:
```php
$users = DB::table('users')
    ->join('roles as r', 'r.id','=','users.role_id)
    ->get();
```
##### Left Join / Right Join Clause
You may use Left Join or Right Join for some case:
```php
$users = DB::table('users')
    ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
    ->get();
```
```php
$users = DB::table('users')
    ->rightJoin('posts', 'users.id', '=', 'posts.user_id')
    ->get();
```

# - Where Clauses
##### Standard Where Clause
Where clause method for basic conditional query, you may use it:

```php
$users = DB::table('users')
    ->where('username', 'arbiyanto')
    ->first();
```
You can do it too with this style:
```php
$users = DB::table('users')
    ->where(['username'=>'arbiyanto'])
    ->first();
```
Or you can use it with operator:
```php
$users = DB::table('users')
    ->where('created_at','>','03-05-2017')
    ->get();
```
You may also pass array of condition:
```php
$users = DB::table('users')->where([
    ['votes','>','80'],
    ['role_id', '=', '1'],
])->get();
```

##### Or Statements
You may use some of optional condition method for your case:
```php
$users = DB::table('users')
    ->where('created_at','>','03-05-2017')
    ->orWhere('updated_at','>','03-05-2017')
    ->get();
```
You may also pass array of condition:
```php
$users = DB::table('users')->where([
    ['votes','>','80'],
    ['role_id', '=', '1'],
])->orWhere([
    ['created_at','>','03-05-2017'],
    ['updated_at','>','03-05-2017'],
])->get();
```
##### Like Statement
You can also doing something simply like searching some of record with `like` statement without rewrite operator in where clause.
```php
$users = DB::table('users')->like('username', 'a%');
$users = DB::table('users')
    ->like('username', 'a%')
    ->orLike('username', 'b%');
```
# - Ordering, Limit & Offset
##### orderBy
You may need to sorting the record for solving the case:
```php
$posts = DB::table('posts')
    ->orderBy('date', 'DESC')
    ->get();
```
##### Limit & Offset
Sometimes you need to limit the number of retrieved record:
```php
$posts = DB::table('posts')
    ->limit(5)
    ->get();
```
You may pass the `offset` parameter in second parameter
```php
$posts = DB::table('posts')
    ->limit(5, 10)
    ->get();
```
You can do it like this too:
```php
$posts = DB::table('posts')
    ->limit(5)
    ->offset(10)
    ->get();
```

# - Inserts
The query builder also provides an `insert` method for inserting records into the database table. The `insert` method accepts an array of column names and values:
```php
DB::table('users')->insert(
    ['email' => 'john@example.com', 'votes' => 0]
);
```
You may even insert several records into the table with a single call to insert by passing an array of arrays. Each array represents a row to be inserted into the table:
```php
DB::table('users')->insert(
    ['email' => 'john@example.com', 'votes' => 0],
    ['email' => 'arbiyanto@example.com', 'votes' => 5],
    ['email' => 'chentong@example.com', 'votes' => 5],
);
```

# - Updates
You may need to updates some of the record:
```php
DB::table('users')
    ->where('username', 'chentong')
    ->update(['username' => 'chenmong']);
```
### Increment & Decrement
The query builder also provides convenient methods for incrementing or decrementing the value of a given column. This is simply a shortcut, providing a more expressive and terse interface compared to manually writing the update statement.
```php
DB::table('users')->increment('votes');

DB::table('users')->increment('votes', 5);

DB::table('users')->decrement('votes');

DB::table('users')->decrement('votes', 5);
```
You may also specify additional columns to simply shortcut where.
```
DB::table('users')->increment('votes', 1, ['name' => 'John']);
```

# - Deletes
The query builder may also be used to delete records from the table via the delete method. Beware, if you doesn't write some of conditional, you may getting all of your data deleted.
```php
DB::table('users')->delete();
```
```php
DB::table('users')->where('username', 'arbi')->delete();
```