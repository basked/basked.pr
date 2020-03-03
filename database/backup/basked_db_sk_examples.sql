INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (1, 1, 'Изингяемые и неизменяемые переенные', 'var i; val k;', null, null, null, null);
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (2, 1, 'Константы', 'const URL', 'konstanty', null, null, '2020-03-03 20:55:38');
INSERT INTO basked_db.sk_examples (id, topic_id, name, code, slug, descr, created_at, updated_at) VALUES (4, 5, 'Элвис-оператор ?:', 'Выражение
val l: Int = if (b != null) b.length else -1
можно заменить 
 val l = b?.length ?: -1
------------------------------------------------------------------
fun foo(node: Node): String? {
     val parent = node.getParent() ?: return null
     val name = node.getName() ?: throw IllegalArgumentException("name expected")
 }', 'elvis-operator', null, '2020-03-03 20:58:24', '2020-03-03 21:19:20');