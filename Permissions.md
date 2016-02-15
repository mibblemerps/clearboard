# Clearboard Permission Nodes

Clearboard uses a permission node system, similar to [Bukkit](http://bukkit.org).

It works by groups having a set of "permission nodes", which is just a string of text such as "cb.post.view".

## Permission Node Reference

| Permission Node | Purpose |
| --------------- | ------- |
| cb.index.view | View the homepage |
| cb.thread.view | View threads |
| cb.profile.view | View profiles |
| cb.thread.create | Create a new thread |
| cb.post.create | Post replies to threads |
| cb.post.create.inLocked | Post replies to threads even if they're locked. |
| cb.post.edit | Edit own posts
| cb.post.edit.others | Edit other peoples posts |
| cb.login | Can the user login? |

> **Note:** not all permission nodes have been implemented yet, therefore this list is subject to change.
